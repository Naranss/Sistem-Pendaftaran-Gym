<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\ProdukTransaksi;
use App\Models\Suplemen;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    // Generate a unique order ID
    public static function generateOrderId()
    {
        return 'ORDER-' . date('YmdHis') . '-' . Str::random(6);
    }

    // Initiate payment and get Midtrans Snap token
    public function pay(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            $cartItems = Keranjang::where('id_akun', $user->id)->with('suplemen')->get();
            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Cart is empty'], 400);
            }

            $total = $cartItems->sum(function ($item) {
                if ($item->membership && $item->harga_membership) {
                    return ($item->jumlah_produk ?? 1) * $item->harga_membership;
                }
                if ($item->suplemen) {
                    return ($item->jumlah_produk ?? 0) * ($item->suplemen->harga ?? ($item->harga_produk ?? 0));
                }
                return 0;
            });

            if ($total <= 0) {
                return response()->json(['message' => 'Invalid cart total'], 400);
            }

            $orderId = self::generateOrderId();

            // Save transaction with pending status
            $transaksi = Transaksi::create([
                'order_id' => $orderId,
                'id_akun' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Midtrans config
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int)$total,
                ],
                'customer_details' => [
                    'first_name' => $user->nama,
                    'email' => $user->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken, 'order_id' => $orderId]);
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());
            return response()->json(['message' => 'Payment error: ' . $e->getMessage()], 500);
        }
    }

    // Midtrans callback/notification
    public function callback(Request $request)
    {
        try {
            $serverKey = env('MIDTRANS_SERVER_KEY');
            $signatureKey = $request->input('signature_key');
            $orderId = $request->input('order_id');
            $statusCode = $request->input('status_code');
            $grossAmount = $request->input('gross_amount');
            $transactionStatus = $request->input('transaction_status');
            $paymentType = $request->input('payment_type');
            $fraudStatus = $request->input('fraud_status');

            // Validate required fields
            if (!$orderId || !$statusCode || !$grossAmount || !$transactionStatus) {
                Log::warning('Missing required Midtrans callback fields', [
                    'order_id' => $orderId,
                    'status_code' => $statusCode,
                    'gross_amount' => $grossAmount,
                    'transaction_status' => $transactionStatus
                ]);
                return response()->json(['message' => 'Missing required callback fields'], 400);
            }

            // Validate signature for security
            $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
            if ($signatureKey !== $expectedSignature) {
                Log::warning('Invalid Midtrans signature for order: ' . $orderId);
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            // Find transaction
            $transaksi = Transaksi::where('order_id', $orderId)->first();
            if (!$transaksi) {
                Log::warning('Transaction not found for order: ' . $orderId);
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // Map Midtrans transaction status to our status
            $statusMapping = $this->mapMidtransStatus($transactionStatus, $paymentType, $fraudStatus);

            // Update transaction status and payment method
            $transaksi->status = $statusMapping;
            $transaksi->metode_pembayaran = $paymentType ?? 'midtrans';
            $transaksi->save();

            Log::info("Transaction {$orderId} status mapped from {$transactionStatus} to {$statusMapping}");

            // If payment successful, clear the user's cart and decrease stock
            if ($statusMapping === 'success') {
                // Get all products in this transaction
                $produkTransaksi = ProdukTransaksi::where('id_transaksi', $transaksi->id)->get();
                
                // Decrease stock for each product
                foreach ($produkTransaksi as $prod) {
                    if ($prod->id_produk) {
                        // This is a supplement product
                        $suplemen = Suplemen::find($prod->id_produk);
                        if ($suplemen) {
                            $suplemen->stok = max(0, ($suplemen->stok ?? 0) - ($prod->jumlah_produk ?? 1));
                            $suplemen->save();
                            Log::info("Stock decreased for suplemen {$suplemen->id}: -{$prod->jumlah_produk}, new stock: {$suplemen->stok}");
                        }
                    }
                }
                
                // Clear the user's cart
                Keranjang::where('id_akun', $transaksi->id_akun)->delete();
                Log::info("Cart cleared for user {$transaksi->id_akun} after successful payment");
            }

            return response()->json(['message' => 'Callback received and processed']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return response()->json(['message' => 'Callback processing error: ' . $e->getMessage()], 500);
        }
    }

    // Map Midtrans transaction status to our application status
    private function mapMidtransStatus($transactionStatus, $paymentType, $fraudStatus)
    {
        switch ($transactionStatus) {
            case 'capture':
                if ($paymentType == 'credit_card') {
                    if ($fraudStatus == 'challenge') {
                        return 'pending';
                    } else {
                        return 'success';
                    }
                }
                return 'success';
                break;
            case 'settlement':
                return 'success';
                break;
            case 'pending':
                return 'pending';
                break;
            case 'deny':
                return 'canceled';
                break;
            case 'expire':
                return 'canceled';
                break;
            case 'cancel':
                return 'canceled';
                break;
            default:
                return 'pending';
        }
    }
}
