<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart contents
     */
    public function index()
    {
        $cartItems = Keranjang::where('user_id', Auth::id())
            ->with('suplemen')
            ->get();

        $total = $cartItems->sum(function ($item) {
            // Handle case where suplemen might be null
            if ($item->suplemen) {
                return ($item->jumlah_produk ?? 0) * ($item->suplemen->harga ?? ($item->harga_produk ?? 0));
            }
            return 0;
        });

        return view('pages.cart', compact('cartItems', 'total'));
    }

    /**
     * Add an item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'id_suplemen' => 'required|exists:suplemen,id',
            'jumlah_produk' => 'required|integer|min:1'
        ]);

        $existing = Keranjang::where('user_id', Auth::id())
            ->where('id_suplemen', $request->id_suplemen)
            ->first();

        if ($existing) {
            $existing->jumlah_produk += $request->jumlah_produk;
            $existing->harga_produk = $request->harga_produk ?? $existing->harga_produk;
            $existing->save();
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'id_suplemen' => $request->id_suplemen,
                'jumlah_produk' => $request->jumlah_produk,
                'harga_produk' => $request->harga_produk ?? null
            ]);
        }

        return redirect()->back()->with('success', __('Item added to cart successfully'));
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        $cartItem = Keranjang::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($request->action === 'increase') {
            $cartItem->jumlah_produk = ($cartItem->jumlah_produk ?? 0) + 1;
        } else {
            $cartItem->jumlah_produk = max(1, ($cartItem->jumlah_produk ?? 1) - 1);
        }

        $cartItem->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        Keranjang::where('user_id', Auth::id())
            ->findOrFail($id)
            ->delete();

        return redirect()->back()->with('success', __('Item removed from cart'));
    }

    /**
     * Process checkout
     */
    public function checkout()
    {
        // Clear the cart and redirect with a success message
        Keranjang::where('user_id', Auth::id())->delete();
        return redirect()->route('homepage')->with('success', __('Thank you for your purchase!'));
    }
}
