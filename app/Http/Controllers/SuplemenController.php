<?php

namespace App\Http\Controllers;

use App\Models\Suplemen;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuplemenController extends Controller
{
    public function index()
    {
        $supplements = Suplemen::with('gambarSuplemen')->filter(request(['search']))->paginate(6);

        return view('pages.suplemen', compact('supplements'));
    }

    public function show($id_suplemen)
    {
        $suplemen = Suplemen::with('gambarSuplemen')->find($id_suplemen);
        return view('pages.detail_suplemen', compact('suplemen'));
    }

    // Add selected supplement to cart with quantity
    public function addToCart(Request $request)
    {
        $request->validate([
            'id_suplemen' => 'required|exists:suplemen,id',
            'jumlah_produk' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();

        // Try to find existing cart item for this user + supplement
        $existing = Keranjang::where('id_akun', $userId)
            ->where('id_suplemen', $request->id_suplemen)
            ->first();

        if ($existing) {
            $existing->jumlah_produk = ($existing->jumlah_produk ?? 0) + $request->jumlah_produk;
            // preserve harga_produk if present, or set from request
            if ($request->filled('harga_produk')) {
                $existing->harga_produk = $request->input('harga_produk');
            }
            $existing->save();
        } else {
            Keranjang::create([
                'id_akun' => $userId,
                'id_suplemen' => $request->id_suplemen,
                'jumlah_produk' => $request->jumlah_produk,
                'harga_produk' => $request->input('harga_produk') ?? null,
            ]);
        }

        return redirect()->back()->with('success', __('Item added to cart successfully'));
    }

}
