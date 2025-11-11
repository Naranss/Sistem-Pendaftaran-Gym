<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
class CatatTransaksiController extends Controller
{
    // Redirect to page transaksi
    public function index(Request $request)
    {
        if (Auth::user()->role != 'ADMIN') {
            return redirect()->route('homepage')->with('error', 'Unauthorized');
        }
        
        $query = Transaksi::with(['user', 'keranjang.suplemen', 'kontrak']);
        
        if ($request->has('search') && $request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $transaksi = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.kel_transaksi', compact('transaksi'));
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
