<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PerbaruiMembershipController extends Controller
{
    public function formPerbaruiMembership()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses formulir pembaruan membership');
        }

        $akun = Akun::where('idUser', $user->idUser)->first();

        return view('member.perbarui_membership', [
            'user' => $akun,
            'status_membership' => $this->checkMembershipStatus($akun)
        ]);
    }


    public function perbaruiKeranjang(Request $request)
    {
        $request->validate([
            'membership' => 'required|in:bulanan,per3bulan,tahunan',
            'harga_membership' => 'required|numeric|min:0'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk memperbarui keranjang');
        }

        try {
            // Mencari atau membuat entri keranjang untuk pembaruan membership
            $keranjang = Keranjang::firstOrCreate(
                ['id_suplemen' => null],
                [
                    'membership' => $request->membership,
                    'harga_membership' => $request->harga_membership,
                    'jumlah_produk' => 1
                ]
            );

            // Memperbarui detail membership jika keranjang sudah ada
            if (!$keranjang->wasRecentlyCreated) {
                $keranjang->update([
                    'membership' => $request->membership,
                    'harga_membership' => $request->harga_membership,
                    'jumlah_produk' => 1
                ]);
            }

            // Membuat catatan transaksi
            $transaksi = Transaksi::create([
                'tanggal' => Carbon::now(),
                'id_produk' => $keranjang->id,
                'id_kontrak' => null,
                'membership' => $request->membership,
                'jumlah_produk' => 1,
                'harga_produk' => 0,
                'harga_kontrak' => 0,
                'harga_membership' => $request->harga_membership,
                'metode_pembayaran' => $request->metode_pembayaran ?? 'pending',
                'user_id' => $user->idUser
            ]);

            // Memperbarui tanggal membership pengguna
            $akun = Akun::where('idUser', $user->idUser)->first();
            $start_date = $this->calculateMembershipStartDate($akun);
            $end_date = $this->calculateMembershipEndDate($start_date, $request->membership);

            $akun->update([
                'membership_start' => $start_date,
                'membership_end' => $end_date
            ]);

            return redirect()->route('member.transaksi')->with('success', 'Membership berhasil diperbarui dan ditambahkan ke keranjang');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui keranjang: ' . $e->getMessage());
        }
    }


    private function checkMembershipStatus(Akun $akun)
    {
        if (!$akun->membership_start || !$akun->membership_end) {
            return 'tidak_aktif';
        }

        $now = Carbon::now();
        if ($now->between($akun->membership_start, $akun->membership_end)) {
            return 'aktif';
        }

        return 'expired';
    }


    private function calculateMembershipStartDate(Akun $akun)
    {
        $now = Carbon::now();
        $status = $this->checkMembershipStatus($akun);

        // Jika membership masih aktif, mulai dari tanggal berakhir saat ini
        if ($status === 'aktif' && $akun->membership_end) {
            return Carbon::parse($akun->membership_end)->addDay();
        }

        // Jika tidak aktif atau kedaluwarsa, mulai dari sekarang
        return $now;
    }

    private function calculateMembershipEndDate($start_date, $membership)
    {
        $start = Carbon::parse($start_date);

        switch ($membership) {
            case 'bulanan':
                return $start->addMonth();
            case 'per3bulan':
                return $start->addMonths(3);
            case 'tahunan':
                return $start->addYear();
            default:
                return $start->addMonth();
        }
    }
}
