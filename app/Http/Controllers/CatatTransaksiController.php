<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Akun;
use App\Models\Suplemen;
use App\Models\MembershipPlan;
use App\Models\Kontrak;
use App\Models\ProdukTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CatatTransaksiController extends Controller
{
    // Redirect to page transaksi
    public function index(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }
        
        $query = Transaksi::with(['user', 'produkTransaksi.suplemen', 'produkTransaksi.membershipPlan', 'produkTransaksi.kontrak']);
        
        if ($request->has('search') && $request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $transaksi = $query->orderBy('created_at', 'desc')->paginate(10);
        $users = Akun::where('role', '!=', 'ADMIN')->get();
        $supplements = Suplemen::all();
        $memberships = MembershipPlan::all();
        $trainers = Akun::where('role', 'TRAINER')->get();
        
        return view('pages.admin.kel_transaksi', compact('transaksi', 'users', 'supplements', 'memberships', 'trainers'));
    }

    // Store new transaction
    public function store(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('admin.transaksi')->with('error', 'Unauthorized');
        }

        \Log::info('Transaction store called', $request->all());

        // Validate input
        $validated = $request->validate([
            'id_akun' => 'required|exists:akun,id',
            'transaction_type' => 'required|string|in:supplement,membership,contract',
            'total' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string|in:CASH,TRANSFER,DEBIT,CREDIT,E-WALLET',
            'status' => 'required|string|in:pending,success,canceled',
            'order_id' => 'nullable|string',
            'supplement_id' => 'nullable|array',
            'supplement_id.*' => 'nullable|exists:suplemen,id',
            'supplement_quantity' => 'nullable|array',
            'supplement_quantity.*' => 'nullable|integer|min:1',
            'membership_id' => 'nullable|exists:membership_plan,id',
            'trainer_id' => 'nullable|exists:akun,id',
            'contract_price' => 'nullable|numeric|min:0',
        ]);

        Log::info('Validation passed', $validated);

        try {
            // Create transaction
            $transaksi = new Transaksi();
            $transaksi->id_akun = $validated['id_akun'];
            $transaksi->total = $validated['total'];
            $transaksi->metode_pembayaran = $validated['metode_pembayaran'];
            $transaksi->status = $validated['status'];
            $transaksi->order_id = $validated['order_id'] ?? null;
            $transaksi->save();

            // Create product transaction record based on type
            $transactionType = $validated['transaction_type'];

            if ($transactionType === 'supplement') {
                $supplementIds = $request->input('supplement_id', []);
                $quantities = $request->input('supplement_quantity', []);

                // Process each supplement
                foreach ($supplementIds as $index => $supplementId) {
                    if (!$supplementId) continue;

                    $supplement = Suplemen::findOrFail($supplementId);
                    $quantity = $quantities[$index] ?? 1;

                    // Check stock
                    if ($supplement->stok < $quantity) {
                        $transaksi->delete();
                        return redirect()->route('admin.transaksi')->with('error', __('Insufficient stock for ') . $supplement->nama_suplemen);
                    }

                    // Create product transaction record
                    ProdukTransaksi::create([
                        'id_transaksi' => $transaksi->id,
                        'id_produk' => $supplement->id,
                        'jumlah_produk' => $quantity,
                        'harga_produk' => $supplement->harga,
                    ]);

                    // Deduct stock
                    $supplement->decrement('stok', $quantity);
                }

            } elseif ($transactionType === 'membership') {
                $membership = MembershipPlan::findOrFail($validated['membership_id']);

                // Create product transaction record
                ProdukTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_membership' => $membership->id,
                    'harga_membership' => $membership->harga,
                ]);

                // Update user to MEMBER role and set membership dates
                if ($validated['status'] === 'success') {
                    $user = Akun::findOrFail($validated['id_akun']);
                    $user->role = 'MEMBER';
                    
                    // If user already has an active membership, extend it; otherwise start new
                    if ($user->membership_end && $user->membership_end > now()) {
                        // Extend existing membership
                        $user->membership_end = $user->membership_end->addMonths($membership->durasi);
                    } else {
                        // Start new membership
                        $user->membership_start = now();
                        $user->membership_end = now()->addMonths($membership->durasi);
                    }
                    
                    $user->save();
                }

            } elseif ($transactionType === 'contract') {
                $trainer = Akun::findOrFail($validated['trainer_id']);

                // Create a contract record
                $kontrak = new Kontrak();
                $kontrak->id_trainer = $trainer->id;
                $kontrak->id_client = $validated['id_akun'];
                $kontrak->status = $validated['status'] === 'success' ? 'active' : 'pending';
                $kontrak->tanggal_berakhir = now()->addMonths(1); // Default 1 month contract
                $kontrak->save();

                // Create product transaction record
                ProdukTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_kontrak' => $kontrak->id,
                    'harga_kontrak' => $validated['total'],
                ]);
            }

            return redirect()->route('admin.transaksi')->with('success', __('Transaction added successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.transaksi')->with('error', __('Failed to add transaction: ') . $e->getMessage());
        }
    }

    // Show transaction details
    public function show($id)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }

        $transaction = Transaksi::with(['user', 'produkTransaksi.suplemen', 'produkTransaksi.membershipPlan', 'produkTransaksi.kontrak'])->findOrFail($id);
        return view('pages.admin.transaction_details', compact('transaction'));
    }

    public function formTransaksiBaru(){
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        return view('admin.form_transaksi_baru');
    }

    public function kirimDataTransaksi($nama,$layanan,$jumlahPembayaran,$metodePembayaran,$tanggal){
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        $transaksi = new Transaksi();
        $transaksi->nama = $nama;
        $transaksi->layanan = $layanan;
        $transaksi->jumlah_pembayaran = $jumlahPembayaran;
        $transaksi->metode_pembayaran = $metodePembayaran;
        $transaksi->tanggal = $tanggal;
        $transaksi->save();
        return redirect()->route('admin.catat_transaksi')->with('success', 'Transaksi berhasil dicatat.');
    }
}
