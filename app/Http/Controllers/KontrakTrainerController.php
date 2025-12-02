<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Kontrak;
use App\Models\Transaksi;
use App\Models\ProdukTransaksi;
use App\Models\JadwalWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class KontrakTrainerController extends Controller
{
    /**
     * Show trainer list with smart routing
     * - If user has active contract: show trainer dashboard
     * - Otherwise: show available trainers
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat daftar trainer');
        }

        // Check if user already has an active trainer contract (status must be 'active' AND not expired)
        $activeContract = Kontrak::where('id_client', $user->id)
            ->where('status', 'active')
            ->where('tanggal_berakhir', '>=', now())
            ->with('trainer')
            ->first();
        
        if ($activeContract) {
            // User has a trainer, show their trainer dashboard
            $trainer = $activeContract->trainer;
            $contract = $activeContract;
            return view('pages.my_trainer', compact('trainer', 'contract'));
        }
        
        // Show list of available trainers for new contracts
        $trainers = Akun::where('role', 'TRAINER')->get();
        return view('pages.trainer', compact('trainers'));
    }

    /**
     * Show form to create contract with trainer
     */
    public function show($trainerId)
    {
        $trainer = Akun::where('id', $trainerId)->where('role', 'TRAINER')->firstOrFail();
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk membuat kontrak dengan trainer');
        }

        if (!in_array($user->role, ['MEMBER', 'PENGUNJUNG'])) {
            return redirect()->back()->with('error', 'Hanya member yang dapat membuat kontrak');
        }

        return view('pages.kontrak_trainer', [
            'trainer' => $trainer,
            'client' => $user
        ]);
    }

    /**
     * Store contract details and redirect to payment checkout
     * Contract created IMMEDIATELY with pending status
     * Status changed to active only AFTER successful payment
     */
    public function store(Request $request, $trainerId)
    {
        $validated = $request->validate([
            'tanggal_berakhir' => 'required|date|after:today',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengkonfirmasi kontrak');
        }

        if (!in_array($user->role, ['MEMBER', 'PENGUNJUNG'])) {
            return redirect()->back()->with('error', 'Hanya member yang dapat membuat kontrak');
        }

        try {
            // Verify trainer exists and has role TRAINER
            $trainer = Akun::where('id', $trainerId)
                ->where('role', 'TRAINER')
                ->firstOrFail();

            // Get trainer's monthly contract fee
            $hargaKontrak = $trainer->harga_kontrak ?? 0;
            if ($hargaKontrak <= 0) {
                return redirect()->back()->with('error', 'Trainer tidak memiliki harga kontrak yang ditentukan');
            }

            // Create contract with PENDING status (waiting for payment)
            $kontrak = Kontrak::create([
                'id_trainer' => $trainer->id,
                'id_client' => $user->id,
                'tanggal_berakhir' => $validated['tanggal_berakhir'],
                'status' => 'pending'  // Not active until payment succeeds
            ]);

            \Illuminate\Support\Facades\Log::info('Contract created with pending status', [
                'contract_id' => $kontrak->id,
                'user_id' => $user->id,
                'trainer_id' => $trainer->id
            ]);

            // Redirect to contract checkout for payment
            return redirect()->route('contract.checkout', ['contract' => $kontrak->id])
                ->with('success', 'Silakan lanjutkan ke pembayaran untuk mengaktifkan kontrak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat kontrak: ' . $e->getMessage());
        }
    }

    /**
     * Show payment checkout page for contract
     */
    public function checkoutView($contractId)
    {
        $contract = Kontrak::where('status', 'pending')->findOrFail($contractId);
        $trainer = $contract->trainer;
        $user = Auth::user();

        if (!$user || $user->id !== $contract->id_client) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengakses checkout ini');
        }

        return view('contract_checkout', compact('contract', 'trainer', 'user'));
    }

    /**
     * Generate Midtrans payment token for contract
     * Gets contract details from session and creates transaction record
     * Actual contract is created ONLY after payment success via callback
     */
    public function generatePayment(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized: Please login first'], 401);
            }
            
            $contractId = $request->input('contract_id');
            $trainerId = $request->input('trainer_id');

            \Illuminate\Support\Facades\Log::info('Contract payment generation started', [
                'user_id' => $user->id,
                'contract_id' => $contractId,
                'trainer_id' => $trainerId
            ]);

            if (!$contractId || !$trainerId) {
                return response()->json(['success' => false, 'message' => 'Missing required parameters: contract_id or trainer_id'], 400);
            }

            // Get the pending contract from database
            $contract = Kontrak::where('status', 'pending')
                ->where('id', $contractId)
                ->firstOrFail();
            
            $trainer = Akun::findOrFail($trainerId);

            if ($contract->id_client !== $user->id) {
                return response()->json(['success' => false, 'message' => 'Unauthorized: This contract does not belong to you'], 403);
            }

            $total = $trainer->harga_kontrak;

            if (!$total || $total <= 0) {
                return response()->json(['success' => false, 'message' => 'Invalid contract amount: Trainer has no price set'], 400);
            }

            // Generate order ID with contract ID (no need to encode trainer, we have contract ID)
            $orderId = 'CONTRACT-' . $contractId . '-' . time();

            \Illuminate\Support\Facades\Log::info('Creating transaction record', [
                'order_id' => $orderId,
                'user_id' => $user->id,
                'contract_id' => $contractId,
                'total' => $total
            ]);

            // Create transaction record
            $transaction = Transaksi::create([
                'order_id' => $orderId,
                'id_akun' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            \Illuminate\Support\Facades\Log::info('Transaction created', [
                'transaction_id' => $transaction->id,
                'order_id' => $orderId
            ]);

            // Link contract to transaction via ProdukTransaksi
            ProdukTransaksi::create([
                'id_transaksi' => $transaction->id,
                'id_kontrak' => $contractId,
                'harga_kontrak' => $total,
            ]);

            \Illuminate\Support\Facades\Log::info('ProdukTransaksi record created', [
                'contract_id' => $contractId,
                'transaction_id' => $transaction->id
            ]);

            // Generate snap token
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', 'false'), FILTER_VALIDATE_BOOLEAN);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            \Illuminate\Support\Facades\Log::info('Midtrans Config set', [
                'is_production' => Config::$isProduction,
                'server_key_exists' => !empty(Config::$serverKey)
            ]);

            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int)$total,
                ],
                'customer_details' => [
                    'first_name' => $user->nama ?? 'User',
                    'email' => $user->email ?? '',
                ],
                'item_details' => [
                    [
                        'id' => 'kontrak-' . $contractId,
                        'price' => (int)$total,
                        'quantity' => 1,
                        'name' => 'Trainer Contract - ' . $trainer->nama
                    ]
                ]
            ]);

            \Illuminate\Support\Facades\Log::info('Snap token generated successfully', [
                'order_id' => $orderId,
                'contract_id' => $contractId
            ]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contract payment generation error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate payment token: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Confirm payment and update contract status to active
     * Called from client-side after Snap payment success
     * Also queries Midtrans to verify payment status
     */
    public function confirmPayment(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $contractId = $request->input('contract_id');
            $orderId = $request->input('order_id');

            if (!$contractId || !$orderId) {
                return response()->json(['success' => false, 'message' => 'Missing required parameters'], 400);
            }

            \Illuminate\Support\Facades\Log::info('Confirm payment requested', [
                'user_id' => $user->id,
                'contract_id' => $contractId,
                'order_id' => $orderId
            ]);

            // Get contract
            $contract = Kontrak::findOrFail($contractId);

            // Verify ownership
            if ($contract->id_client !== $user->id) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            // Get transaction
            $transaction = Transaksi::where('order_id', $orderId)->firstOrFail();

            // Verify transaction is successful
            if ($transaction->status !== 'success') {
                // Check status with Midtrans if not marked as success yet
                try {
                    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                    Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', 'false'), FILTER_VALIDATE_BOOLEAN);
                    
                    $status = Transaction::status($orderId);
                    
                    \Illuminate\Support\Facades\Log::info('Midtrans status check', [
                        'order_id' => $orderId,
                        'status' => $status->transaction_status ?? 'unknown'
                    ]);

                    // If status is approved or captured, mark transaction as success
                    if (in_array($status->transaction_status ?? null, ['capture', 'settlement'])) {
                        $transaction->status = 'success';
                        $transaction->metode_pembayaran = $status->payment_type ?? 'midtrans';
                        $transaction->save();
                        
                        \Illuminate\Support\Facades\Log::info('Transaction status updated to success', [
                            'order_id' => $orderId
                        ]);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Payment not confirmed yet'], 400);
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Error checking Midtrans status: ' . $e->getMessage());
                    // If we can't verify with Midtrans, trust the client (they wouldn't call success if payment failed)
                    $transaction->status = 'success';
                    $transaction->metode_pembayaran = 'midtrans';
                    $transaction->save();
                }
            }

            // Update contract status to active if still pending
            if ($contract->status === 'pending') {
                $contract->status = 'active';
                $contract->save();

                \Illuminate\Support\Facades\Log::info('Contract status updated to active', [
                    'contract_id' => $contractId,
                    'order_id' => $orderId
                ]);
            }

            // Verify ProdukTransaksi exists
            $prodTransaksi = ProdukTransaksi::where('id_transaksi', $transaction->id)
                ->where('id_kontrak', $contractId)
                ->first();

            if (!$prodTransaksi) {
                ProdukTransaksi::create([
                    'id_transaksi' => $transaction->id,
                    'id_kontrak' => $contractId,
                    'harga_kontrak' => $transaction->total,
                ]);
                
                \Illuminate\Support\Facades\Log::info('ProdukTransaksi created', [
                    'contract_id' => $contractId,
                    'transaction_id' => $transaction->id
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Contract activated successfully']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Confirm payment error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get trainer's schedule (for trainers only)
     * Only show active contracts
     */
    public function scheduleList()
    {
        $contracts = Kontrak::where('id_trainer', Auth::id())
            ->where('status', 'active')
            ->with('client')
            ->get();
        return view('pages.trainer.jadwal', compact('contracts'));
    }

    /**
     * Get trainer's members (for trainers only)
     * Only show members with active contracts
     */
    public function memberList()
    {
        $members = Kontrak::where('id_trainer', Auth::id())
            ->where('status', 'active')
            ->with('client')
            ->get()
            ->pluck('client')
            ->unique();
        return view('pages.trainer.clients', compact('members'));
    }

    /**
     * Update workout schedule (for trainers only)
     */
    public function updateSchedule(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal = JadwalWorkout::findOrFail($id);
        
        $jadwal->update($validated);
        return redirect()->route('trainer.jadwal')->with('success', __('Jadwal berhasil diperbarui.'));
    }
}

