<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\JadwalWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function suplemen()
    {
        return view('member.suplemen');
    }

    public function trainer()
    {
        return view('member.trainer');
    }

    public function jadwal()
    {
        $jadwal = JadwalWorkout::where('member_id', Auth::id())->get();
        return view('member.jadwal', compact('jadwal'));
    }

    public function membership()
    {
        $user = Auth::user();
        $akun = $user; // Auth::user() already returns Akun instance
        $status_membership = $akun ? $this->checkMembershipStatus($akun) : 'tidak_aktif';

        return view('pages.member.membership', compact('akun', 'status_membership'));
    }

    public function updateMembership(Request $request)
    {
        $request->validate([
            'membership' => 'required|in:bulanan,per3bulan,tahunan',
            'harga_membership' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:transfer,cash,e-wallet'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk memperbarui membership');
        }

        try {
            $akun = $user; // Auth::user() already returns Akun instance
            
            if (!$akun) {
                return redirect()->back()->with('error', 'Akun tidak ditemukan');
            }

            // Mencari atau membuat entri keranjang untuk pembaruan membership
            $keranjang = Keranjang::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'id_suplemen' => null
                ],
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
                'metode_pembayaran' => $request->metode_pembayaran,
                'user_id' => $user->id
            ]);

            // Menghitung tanggal mulai dan akhir membership
            $start_date = $this->calculateMembershipStartDate($akun);
            $end_date = $this->calculateMembershipEndDate($start_date, $request->membership);

            // Memperbarui tanggal membership pengguna
            $akun->update([
                'membership_start' => $start_date,
                'membership_end' => $end_date
            ]);

            return redirect()->route('member.membership')->with('success', 'Membership berhasil diperbarui dan ditambahkan ke keranjang');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui membership: ' . $e->getMessage());
        }
    }

    public function transaksi()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->get();
        return view('member.transaksi', compact('transaksi'));
    }

    public function formGabungMembership()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses formulir membership');
        }

        $akun = $user; // Auth::user() already returns Akun instance

        return view('member.formulir_membership', [
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
            $akun = $user; // Auth::user() already returns Akun instance
            
            // Mencari atau membuat entri keranjang untuk pengguna
            $keranjang = Keranjang::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'id_suplemen' => null
                ],
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
                'user_id' => $user->id
            ]);

            // Menghitung tanggal mulai dan akhir membership
            $start_date = $this->calculateMembershipStartDate($akun);
            $end_date = $this->calculateMembershipEndDate($start_date, $request->membership);

            // Memperbarui tanggal membership pengguna
            $akun->update([
                'membership_start' => $start_date,
                'membership_end' => $end_date
            ]);

            return redirect()->route('member.transaksi')->with('success', 'Membership berhasil ditambahkan ke keranjang');
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
                return $start->copy()->addMonth();
            case 'per3bulan':
                return $start->copy()->addMonths(3);
            case 'tahunan':
                return $start->copy()->addYear();
            default:
                return $start->copy()->addMonth();
        }
    }
}
