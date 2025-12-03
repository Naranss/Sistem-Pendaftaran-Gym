<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\JadwalWorkout;
use App\Models\Suplemen;
use App\Models\MembershipPlan;
use App\Models\ProdukTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function membership()
    {
        $user = Auth::user();
        $akun = $user;

        // Determine membership status
        $status_membership = 'inactive';
        if ($akun->membership_end) {
            $now = Carbon::now();
            $end = Carbon::parse($akun->membership_end);
            
            if ($now->isBefore($end)) {
                $status_membership = 'aktif';
            } elseif ($now->isAfter($end)) {
                $status_membership = 'expired';
            }
        }

        // Fetch all membership plans from the database
        $membershipPlans = MembershipPlan::all();

        return view('pages.member.membership', compact('akun', 'status_membership', 'membershipPlans'));
    }

    public function membershipPayment(Request $request)
    {
        $user = Auth::user();
        $type = $request->query('type');
        $price = $request->query('price');
        $planId = $request->query('plan_id');

        if (!$type || !$price || !$planId) {
            return redirect()->route('guest.membership')->with('error', __('Invalid membership plan selected'));
        }

        // Find the membership plan details based on ID
        $selectedPlan = MembershipPlan::find($planId);

        if (!$selectedPlan) {
            return redirect()->route('guest.membership')->with('error', __('Membership plan not found'));
        }

        // Verify the price matches
        if ($selectedPlan->harga != $price) {
            return redirect()->route('guest.membership')->with('error', __('Price mismatch'));
        }

        try {
            // Generate order ID for Midtrans
            $orderId = 'MEMBERSHIP-' . $user->id . '-' . time();

            // Do NOT create transaction here - only generate payment token
            // Transaction will be created when Pay Now is clicked and payment is confirmed

            // Generate Midtrans snap token
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $transactionDetails = [
                'order_id' => $orderId,
                'gross_amount' => (int) $price,
            ];

            $itemDetails = [
                [
                    'id' => $selectedPlan->id,
                    'price' => (int) $price,
                    'quantity' => 1,
                    'name' => $selectedPlan->nama_paket_id,
                ]
            ];

            $customerDetails = [
                'first_name' => $user->nama,
                'email' => $user->email,
                'phone' => $user->no_telp,
            ];

            $payload = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);

            // Pass order and plan data to view (no transaction created yet)
            return view('pages.member.membership-payment', [
                'orderId' => $orderId,
                'snapToken' => $snapToken,
                'planId' => $selectedPlan->id,
                'price' => $price,
                'selectedPlan' => $selectedPlan,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Membership payment generation error: ' . $e->getMessage());
            return redirect()->route('guest.membership')->with('error', __('Failed to generate payment: ') . $e->getMessage());
        }
    }

    public function confirmMembershipPayment(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $orderId = $request->input('order_id');
            $planId = $request->input('plan_id');
            $price = $request->input('price');
            $statusParam = $request->input('status', null); // Check if status is provided (pending from popup close/onPending)

            if (!$orderId || !$planId || !$price) {
                return response()->json(['success' => false, 'message' => 'Missing required parameters'], 400);
            }

            \Illuminate\Support\Facades\Log::info('Confirm membership payment requested', [
                'user_id' => $user->id,
                'order_id' => $orderId,
                'plan_id' => $planId,
                'price' => $price,
                'status_param' => $statusParam
            ]);

            // Check if transaction already exists
            $transaction = Transaksi::where('order_id', $orderId)->first();

            // Determine if this is a pending request or payment confirmation
            $isPending = $statusParam === 'pending';
            $midtransStatus = null;
            
            if (!$isPending) {
                // Verify payment with Midtrans (only for payment confirmations, not pending requests)
                try {
                    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                    \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
                    
                    $status = \Midtrans\Transaction::status($orderId);
                    $midtransStatus = $status->transaction_status ?? 'unknown';
                    
                    \Illuminate\Support\Facades\Log::info('Midtrans status check', [
                        'order_id' => $orderId,
                        'status' => $midtransStatus
                    ]);

                    // Check if payment is successful
                    if (!in_array($midtransStatus, ['capture', 'settlement'])) {
                        return response()->json(['success' => false, 'message' => 'Payment not successful. Status: ' . $midtransStatus], 400);
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Error checking Midtrans status: ' . $e->getMessage());
                    return response()->json(['success' => false, 'message' => 'Could not verify payment: ' . $e->getMessage()], 400);
                }
            }

            // If transaction doesn't exist, create it
            if (!$transaction) {
                $transactionStatus = $isPending ? 'pending' : 'success';
                
                $transaction = Transaksi::create([
                    'order_id' => $orderId,
                    'id_akun' => $user->id,
                    'total' => (int) $price,
                    'status' => $transactionStatus,
                    'metode_pembayaran' => 'transfer',
                ]);

                \Illuminate\Support\Facades\Log::info('New transaction created for membership', [
                    'order_id' => $orderId,
                    'transaction_id' => $transaction->id,
                    'transaction_status' => $transactionStatus
                ]);
            } else {
                // Update existing transaction status
                $transactionStatus = $isPending ? 'pending' : 'success';
                
                $transaction->update([
                    'status' => $transactionStatus,
                    'metode_pembayaran' => 'transfer',
                ]);

                \Illuminate\Support\Facades\Log::info('Existing transaction updated', [
                    'order_id' => $orderId,
                    'transaction_id' => $transaction->id,
                    'transaction_status' => $transactionStatus
                ]);
            }

            // Get membership plan
            $selectedPlan = MembershipPlan::findOrFail($planId);

            // Create ProdukTransaksi record if it doesn't exist
            $prodTransaksi = ProdukTransaksi::where('id_transaksi', $transaction->id)
                ->where('id_membership', $planId)
                ->first();

            if (!$prodTransaksi) {
                ProdukTransaksi::create([
                    'id_transaksi' => $transaction->id,
                    'id_produk' => null,
                    'id_kontrak' => null,
                    'id_membership' => $planId,
                    'jumlah_produk' => 1,
                    'harga_produk' => null,
                    'harga_kontrak' => null,
                    'harga_membership' => (int) $price,
                ]);
                
                \Illuminate\Support\Facades\Log::info('ProdukTransaksi created for membership', [
                    'plan_id' => $planId,
                    'transaction_id' => $transaction->id
                ]);
            }

            // Only update user account if payment is successful (not pending)
            if (!$isPending && in_array($midtransStatus, ['capture', 'settlement'])) {
                $durasi = $selectedPlan->durasi;

                // Check if user is PENGUNJUNG before changing to MEMBER
                if ($user->role === 'PENGUNJUNG' || $user->role === 'pengunjung') {
                    // New member: start from today and add duration
                    $membershipStart = Carbon::now();
                    $membershipEnd = $membershipStart->copy()->addMonths($durasi);
                    
                    $user->update([
                        'role' => 'MEMBER',
                        'membership_start' => $membershipStart,
                        'membership_end' => $membershipEnd,
                    ]);

                    \Illuminate\Support\Facades\Log::info('User upgraded to MEMBER', [
                        'user_id' => $user->id,
                        'membership_start' => $membershipStart,
                        'membership_end' => $membershipEnd
                    ]);
                } else {
                    // If already a member, add duration to existing end date
                    $currentEndDate = Carbon::parse($user->membership_end);
                    $membershipEnd = $currentEndDate->copy()->addMonths($durasi);
                    
                    $user->update([
                        'membership_end' => $membershipEnd,
                    ]);

                    \Illuminate\Support\Facades\Log::info('Existing member membership extended', [
                        'user_id' => $user->id,
                        'previous_end' => $currentEndDate,
                        'new_end' => $membershipEnd,
                        'added_months' => $durasi
                    ]);
                }

                return response()->json(['success' => true, 'message' => 'Membership activated successfully']);
            } else if ($isPending) {
                return response()->json(['success' => true, 'message' => 'Pending transaction created. You can complete payment later.']);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Confirm membership payment error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

}
