<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Kontrak;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class KontrakTrainerController extends Controller
{
    public function formDaftarTrainer()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat daftar trainer');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat mengakses daftar trainer');
        }

        // Mengambil semua akun dengan role TRAINER
        $trainers = Akun::where('role', 'TRAINER')->get();

        return view('member.daftar_trainer', compact('trainers'));
    }

    public function formTrainer($idTrainer)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk membuat kontrak dengan trainer');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat membuat kontrak');
        }

        // Memastikan trainer ada dan memiliki role TRAINER
        $trainer = Akun::where('idUser', $idTrainer)->where('role', 'TRAINER')->first();

        if (!$trainer) {
            return redirect()->route('member.daftar_trainer')->with('error', 'Trainer tidak ditemukan');
        }

        return view('pages.kontrak_trainer', [
            'trainer' => $trainer,
            'client' => $user
        ]);
    }


    public function konfirmasiDanPembayaran(Request $request)
    {
        $request->validate([
            'idTrainer' => 'required|exists:akun,id',
            'tanggal_berakhir' => 'required|date|after:today'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengkonfirmasi kontrak');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat mengkonfirmasi kontrak');
        }

        try {
            // Memastikan trainer memiliki role TRAINER
            $trainer = Akun::where('id', $request->idTrainer)->where('role', 'TRAINER')->first();
            if (!$trainer) {
                return redirect()->back()->with('error', 'Trainer tidak valid');
            }

            // Get trainer's monthly contract fee
            $hargaKontrak = $trainer->harga_kontrak ?? 0;
            if ($hargaKontrak <= 0) {
                return redirect()->back()->with('error', 'Trainer tidak memiliki harga kontrak yang ditentukan');
            }

            // Membuat kontrak
            $kontrak = Kontrak::create([
                'id_trainer' => $trainer->id,
                'id_client' => $user->id,
                'tanggal_berakhir' => $request->tanggal_berakhir
            ]);

            // Redirect to contract checkout for payment
            return redirect()->route('contract.checkout', ['contract' => $kontrak->id])->with('success', 'Kontrak berhasil dibuat. Silakan lanjutkan ke pembayaran.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi kontrak: ' . $e->getMessage());
        }
    }

    public function checkoutView($contractId)
    {
        $contract = Kontrak::findOrFail($contractId);
        $trainer = $contract->trainer;
        $user = Auth::user();

        if ($user->id !== $contract->id_client) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengakses checkout ini');
        }

        return view('contract_checkout', compact('contract', 'trainer'));
    }

    public function generatePayment(Request $request)
    {
        try {
            $user = Auth::user();
            
            $contractId = $request->input('contract_id');
            $trainerId = $request->input('trainer_id');

            if (!$contractId || !$trainerId) {
                return response()->json(['success' => false, 'message' => 'Missing required parameters'], 400);
            }

            $contract = Kontrak::findOrFail($contractId);
            $trainer = Akun::findOrFail($trainerId);

            if ($contract->id_client !== $user->id) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            $total = $trainer->harga_kontrak;

            if ($total <= 0) {
                return response()->json(['success' => false, 'message' => 'Invalid contract amount'], 400);
            }

            // Generate order ID and create transaction
            $orderId = 'CONTRACT-' . $contract->id . '-' . time();

            $transaction = Transaksi::create([
                'order_id' => $orderId,
                'id_akun' => $user->id,
                'total' => $total,
                'status' => 'pending',
                'id_kontrak' => $contract->id,
                'tanggal' => Carbon::now()
            ]);

            // Generate snap token
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int)$total,
                ],
                'customer_details' => [
                    'first_name' => $user->nama,
                    'email' => $user->email,
                ],
                'item_details' => [
                    [
                        'id' => 'kontrak-' . $contract->id,
                        'price' => (int)$total,
                        'quantity' => 1,
                        'name' => 'Trainer Contract - ' . $trainer->nama
                    ]
                ]
            ]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contract payment generation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate payment token'
            ], 500);
        }
    }
}
