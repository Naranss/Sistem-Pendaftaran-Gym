<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
class CatatTransaksiController extends Controller
{
    // Redirect to page transaksi
    public function index()
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('home')->with('error', 'Unauthorized');
        }
        return view('admin.catat_transaksi'); //masih bisa berubah
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
