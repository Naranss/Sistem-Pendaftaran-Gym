<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Kontrak;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        return view('member.form_kontrak_trainer', [
            'trainer' => $trainer,
            'client' => $user
        ]);
    }


    public function konfirmasiDanPembayaran(Request $request)
    {
        $request->validate([
            'idTrainer' => 'required|exists:akuns,idUser',
            'durasiKontrak' => 'required|in:1_bulan,3_bulan,6_bulan',
            'harga_kontrak' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:cash,card,transfer'
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
            $trainer = Akun::where('idUser', $request->idTrainer)->where('role', 'TRAINER')->first();
            if (!$trainer) {
                return redirect()->back()->with('error', 'Trainer tidak valid');
            }

            // Membuat kontrak
            $kontrak = Kontrak::create([
                'idTrainer' => $request->idTrainer,
                'idClient' => $user->idUser,
                'durasiKontrak' => $this->calculateKontrakEndDate($request->durasiKontrak)
            ]);

            // Membuat catatan transaksi
            $transaksi = Transaksi::create([
                'tanggal' => Carbon::now(),
                'id_produk' => null,
                'id_kontrak' => $kontrak->idKontrak,
                'membership' => null,
                'jumlah_produk' => 0,
                'harga_produk' => 0,
                'harga_kontrak' => $request->harga_kontrak,
                'harga_membership' => 0,
                'metode_pembayaran' => $request->metode_pembayaran,
                'user_id' => $user->idUser
            ]);

            return redirect()->route('member.transaksi')->with('success', 'Kontrak dengan trainer berhasil dikonfirmasi dan ditambahkan ke transaksi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi kontrak: ' . $e->getMessage());
        }
    }

    private function calculateKontrakEndDate($durasiKontrak)
    {
        $now = Carbon::now();

        switch ($durasiKontrak) {
            case '1_bulan':
                return $now->addMonth();
            case '3_bulan':
                return $now->addMonths(3);
            case '6_bulan':
                return $now->addMonths(6);
            default:
                return $now->addMonth();
        }
    }
}
