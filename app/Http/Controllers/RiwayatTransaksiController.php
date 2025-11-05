<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class RiwayatTransaksiController extends Controller
{
    public function daftarTransaksiPengguna(){
        if (Auth::user()->role != 'USER') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        $transaksi = Transaksi::all();

        return view('riwayat_transaksi', compact('transaksi'));

    }
    public function cetakBuktiPembayaran(){
        if (Auth::user()->role != 'USER') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        $transaksi = Transaksi::all();
        
        return view('bukti_pembayaran');
    }
}
