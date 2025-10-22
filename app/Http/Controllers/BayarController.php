<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BayarController extends Controller
{
    public function getKeranjang()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat keranjang');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat mengakses keranjang');
        }

        // Mengambil semua item keranjang untuk pengguna
        $keranjang = Keranjang::where('user_id', $user->idUser)->get();

        return view('member.keranjang', compact('keranjang'));
    }

    public function setJumOrder(Request $request)
    {
        $request->validate([
            'id_keranjang' => 'required|exists:keranjang,id',
            'jumlah_produk' => 'required|integer|min:1'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk memperbarui jumlah order');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat memperbarui keranjang');
        }

        try {
            $keranjang = Keranjang::where('id', $request->id_keranjang)
                ->where('user_id', $user->idUser)
                ->firstOrFail();

            $keranjang->update([
                'jumlah_produk' => $request->jumlah_produk
            ]);

            return redirect()->route('member.keranjang')->with('success', 'Jumlah order berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui jumlah order: ' . $e->getMessage());
        }
    }

    public function hitungTotal()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menghitung total');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat menghitung total');
        }

        $keranjang = Keranjang::where('user_id', $user->idUser)->get();
        $total = 0;

        foreach ($keranjang as $item) {
            if ($item->id_suplemen) {
                $total += $item->jumlah_produk * $item->harga_produk;
            } elseif ($item->membership) {
                $total += $item->harga_membership;
            }
        }

        // Mengambil transaksi terkait kontrak untuk menambahkan harga_kontrak
        $transaksiKontrak = Transaksi::where('user_id', $user->idUser)
            ->whereNotNull('id_kontrak')
            ->get();
        foreach ($transaksiKontrak as $transaksi) {
            $total += $transaksi->harga_kontrak;
        }

        return view('member.total_belanja', compact('keranjang', 'total'));
    }

    public function konPembayaranCash(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengkonfirmasi pembayaran');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat mengkonfirmasi pembayaran');
        }

        try {
            $keranjang = Keranjang::where('user_id', $user->idUser)->get();

            foreach ($keranjang as $item) {
                $transaksi = Transaksi::create([
                    'tanggal' => Carbon::now(),
                    'id_produk' => $item->id_suplemen ? $item->id : null,
                    'id_kontrak' => null,
                    'membership' => $item->membership,
                    'jumlah_produk' => $item->jumlah_produk,
                    'harga_produk' => $item->id_suplemen ? $item->harga_produk : 0,
                    'harga_kontrak' => 0,
                    'harga_membership' => $item->membership ? $item->harga_membership : 0,
                    'metode_pembayaran' => 'cash',
                    'user_id' => $user->idUser
                ]);

                // Hapus item dari keranjang setelah transaksi
                $item->delete();
            }

            return redirect()->route('member.transaksi')->with('success', 'Pembayaran cash berhasil dikonfirmasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus item dari keranjang
     */
    public function hapusKeranjang(Request $request)
    {
        $request->validate([
            'id_keranjang' => 'required|exists:keranjang,id'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menghapus item dari keranjang');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat menghapus keranjang');
        }

        try {
            $keranjang = Keranjang::where('id', $request->id_keranjang)
                ->where('user_id', $user->idUser)
                ->firstOrFail();

            $keranjang->delete();

            return redirect()->route('member.keranjang')->with('success', 'Item berhasil dihapus dari keranjang');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus item dari keranjang: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan QR code untuk pembayaran QRIS
     */
    public function showQr()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat QR code pembayaran');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat melihat QR code');
        }

        $qrCodeUrl = 'gambarQR'; // diganti gambar QR

        return view('member.qr_pembayaran', compact('qrCodeUrl'));
    }

    /**
     * Mengkonfirmasi pembayaran dengan metode QRIS
     */
    public function konPembayaranQris(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengkonfirmasi pembayaran QRIS');
        }

        if ($user->role !== 'PENGUNJUNG') {
            return redirect()->back()->with('error', 'Hanya pengguna dengan role PENGUNJUNG yang dapat mengkonfirmasi pembayaran');
        }

        try {
            $keranjang = Keranjang::where('user_id', $user->idUser)->get();

            foreach ($keranjang as $item) {
                $transaksi = Transaksi::create([
                    'tanggal' => Carbon::now(),
                    'id_produk' => $item->id_suplemen ? $item->id : null,
                    'id_kontrak' => null,
                    'membership' => $item->membership,
                    'jumlah_produk' => $item->jumlah_produk,
                    'harga_produk' => $item->id_suplemen ? $item->harga_produk : 0,
                    'harga_kontrak' => 0,
                    'harga_membership' => $item->membership ? $item->harga_membership : 0,
                    'metode_pembayaran' => 'qris',
                    'user_id' => $user->idUser
                ]);

                // Hapus item dari keranjang setelah transaksi
                $item->delete();
            }

            return redirect()->route('member.transaksi')->with('success', 'Pembayaran QRIS berhasil dikonfirmasi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi pembayaran QRIS: ' . $e->getMessage());
        }
    }
}
