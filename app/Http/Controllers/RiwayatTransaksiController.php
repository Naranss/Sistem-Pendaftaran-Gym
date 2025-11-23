<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class RiwayatTransaksiController extends Controller
{
    public function daftarTransaksiPengguna()
    {
        $userId = Auth::id();
        
        // Get user transactions, ordered by newest first
        $transaksi = Transaksi::where('user_id', $userId)
            ->with(['user', 'kontrak', 'kontrak.trainer'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.guest.riwayat_transaksi', compact('transaksi'));
    }

    public function cetakBuktiPembayaran()
    {
        if (Auth::user()->role != 'USER') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }
        $transaksi = Transaksi::all();
        
        return view('bukti_pembayaran');
    }
}
