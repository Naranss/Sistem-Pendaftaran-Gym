<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\ProdukTransaksi;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    // Show checkout page - just display cart items without creating transaction
    public function index()
    {
        $user = Auth::user();
        $cartItems = Keranjang::where('id_akun', $user->id)->with('suplemen')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            if ($item->suplemen) {
                return ($item->jumlah_produk ?? 0) * ($item->suplemen->harga ?? ($item->harga_produk ?? 0));
            }
            return 0;
        });

        $total = $subtotal; // No tax or shipping for now

        // Pass data without creating transaction yet
        $transaction = null;
        $snapToken = null;

        return view('pages.checkout', compact('cartItems', 'subtotal', 'total', 'transaction', 'snapToken'));
    }

    // Generate snap token and create transaction (called by "Proceed to Payment" button)
    public function generatePayment()
    {
        try {
            $user = Auth::user();
            $cartItems = Keranjang::where('id_akun', $user->id)->with('suplemen')->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
            }

            // Calculate total
            $total = $cartItems->sum(function ($item) {
                if ($item->suplemen) {
                    return ($item->jumlah_produk ?? 0) * ($item->suplemen->harga ?? ($item->harga_produk ?? 0));
                }
                return 0;
            });

            if ($total <= 0) {
                return response()->json(['success' => false, 'message' => 'Invalid cart total'], 400);
            }

            // Generate order ID and create transaction
            $orderId = PaymentController::generateOrderId();

            $transaction = Transaksi::create([
                'order_id' => $orderId,
                'id_akun' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Save cart items to produk_transaksi
            foreach ($cartItems as $item) {
                if ($item->suplemen) {
                    ProdukTransaksi::create([
                        'id_transaksi' => $transaction->id,
                        'id_produk' => $item->id_suplemen, // Store suplemen ID, not keranjang ID
                        'jumlah_produk' => $item->jumlah_produk ?? 1,
                        'harga_produk' => $item->suplemen->harga ?? $item->harga_produk ?? 0,
                    ]);
                } elseif ($item->membership) {
                    ProdukTransaksi::create([
                        'id_transaksi' => $transaction->id,
                        'id_kontrak' => $item->id_kontrak ?? null,
                        'harga_membership' => $item->harga_membership ?? 0,
                    ]);
                }
            }

            // Generate snap token
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int)$total,
                ],
                'customer_details' => [
                    'first_name' => $user->nama,
                    'email' => $user->email,
                ],
            ]);

            // Clear cart for this user
            Keranjang::where('id_akun', $user->id)->delete();

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Payment generation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate payment token'
            ], 500);
        }
    }
}
