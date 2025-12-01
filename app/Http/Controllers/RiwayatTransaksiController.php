<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class RiwayatTransaksiController extends Controller
{
    public function daftarTransaksiPengguna()
    {
        $userId = Auth::id();
        
        // Get user transactions, ordered by newest first
        $transaksi = Transaksi::where('id_akun', $userId)
            ->with(['user', 'kontrak', 'kontrak.trainer'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.guest.riwayat_transaksi', compact('transaksi'));
    }

    public function payTransaction($transactionId)
    {
        $user = Auth::user();
        $transaction = Transaksi::where('id', $transactionId)
            ->where('id_akun', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$transaction) {
            return redirect()->route('guest.riwayat')->with('error', 'Transaction not found or already paid');
        }

        try {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Generate a completely fresh unique order_id to avoid Midtrans conflicts
            // Use PaymentController's method for consistency
            $uniqueOrderId = \App\Http\Controllers\PaymentController::generateOrderId();
            
            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $uniqueOrderId,
                    'gross_amount' => (int)$transaction->total,
                ],
                'customer_details' => [
                    'first_name' => $user->nama,
                    'email' => $user->email,
                ],
            ]);

            // Update transaction with the new order_id
            $transaction->update(['order_id' => $uniqueOrderId]);

            return view('pages.payment', compact('transaction', 'snapToken'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Snap token generation error: ' . $e->getMessage());
            return redirect()->route('guest.riwayat')->with('error', 'Failed to generate payment token');
        }
    }

    public function cetakBuktiPembayaran()
    {
        if (Auth::user()->role != 'USER') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }
        $transaksi = Transaksi::all();
        
        return view('bukti_pembayaran');
    }

    public function showDetails($transactionId)
    {
        $user = Auth::user();
        $transaction = Transaksi::where('id', $transactionId)
            ->where('id_akun', $user->id)
            ->with('produkTransaksi.suplemen', 'produkTransaksi.kontrak')
            ->first();

        if (!$transaction) {
            return redirect()->route('guest.riwayat')->with('error', 'Transaction not found');
        }

        return view('pages.transaction-details', compact('transaction'));
    }
}
