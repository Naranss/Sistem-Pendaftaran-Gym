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
        $cartItems = Keranjang::where('id_akun', Auth::id())
            ->with('suplemen')
            ->get();

        $total = $cartItems->sum(function ($item) {
            // Handle membership items
            if ($item->membership && $item->harga_membership) {
                return ($item->jumlah_produk ?? 1) * $item->harga_membership;
            }
            
            // Handle supplement products
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

        // Get the suplemen to check stock
        $suplemen = \App\Models\Suplemen::findOrFail($request->id_suplemen);
        
        // Check if requested quantity exceeds available stock
        if ($request->jumlah_produk > $suplemen->stok) {
            return redirect()->back()->with('error', __('Quantity exceeds available stock. Available: ') . $suplemen->stok);
        }

        // normalize to use `id_akun` column (migration and model use id_akun)
        $existing = Keranjang::where('id_akun', Auth::id())
            ->where('id_suplemen', $request->id_suplemen)
            ->first();

        if ($existing) {
            $newQuantity = ($existing->jumlah_produk ?? 0) + $request->jumlah_produk;
            
            // Check total quantity against stock
            if ($newQuantity > $suplemen->stok) {
                return redirect()->back()->with('error', __('Total quantity exceeds available stock. Available: ') . $suplemen->stok);
            }
            
            $existing->jumlah_produk = $newQuantity;
            // harga_produk column not present in migration; keep existing harga_produk if exists
            if ($request->has('harga_produk')) {
                $existing->harga_produk = $request->harga_produk;
            }
            $existing->save();
        } else {
            Keranjang::create([
                'id_akun' => Auth::id(),
                'id_suplemen' => $request->id_suplemen,
                'jumlah_produk' => $request->jumlah_produk,
                'harga_produk' => $request->get('harga_produk') ?? null
            ]);
        }

        return redirect()->back()->with('success', __('Item added to cart successfully'));
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        // ensure we only find items belonging to the current user (column: id_akun)
        $cartItem = Keranjang::where('id_akun', Auth::id())
            ->with('suplemen')
            ->findOrFail($id);

        $newQuantity = $cartItem->jumlah_produk ?? 0;

        if ($request->action === 'increase') {
            $newQuantity += 1;
        } else {
            $newQuantity = max(1, $newQuantity - 1);
        }

        // Check stock limit if it's a supplement
        if ($cartItem->suplemen) {
            $availableStock = $cartItem->suplemen->stok ?? 0;
            if ($newQuantity > $availableStock) {
                return response()->json([
                    'success' => false,
                    'message' => __('Quantity exceeds available stock. Available: ') . $availableStock
                ], 400);
            }
        }

        $cartItem->jumlah_produk = $newQuantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        Keranjang::where('id_akun', Auth::id())
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
        Keranjang::where('id_akun', Auth::id())->delete();
        return redirect()->route('homepage')->with('success', __('Thank you for your purchase!'));
    }

    /**
     * Clear cart via API
     */
    public function clear()
    {
        try {
            Keranjang::where('id_akun', Auth::id())->delete();
            return response()->json(['success' => true, 'message' => 'Cart cleared']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to clear cart'], 500);
        }
    }
}
