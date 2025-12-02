# Contract Payment Gateway Implementation

## Overview
Added a complete payment gateway system for trainer contracts, mirroring the cart/checkout system with Midtrans integration.

## Changes Made

### 1. **Database Migration** ✅
- **File**: `database/migrations/2025_12_02_000000_add_harga_kontrak_to_akun_table.php`
- Added `harga_kontrak` column to `akun` table (decimal 10,2)
- Stores monthly contract fee for trainers

### 2. **Contract Checkout View** ✅
- **File**: `resources/views/contract_checkout.blade.php`
- Similar layout to cart checkout
- Displays:
  - Trainer information (name, email, phone)
  - Contract details (duration, monthly fee, dates)
  - Payment summary with total amount
  - "Pay Now" button with Midtrans integration

### 3. **Controller Updates** ✅
- **File**: `app/Http/Controllers/KontrakTrainerController.php`

**New Methods:**
- `checkoutView($contractId)` - Display contract checkout page
- `generatePayment(Request $request)` - Generate Midtrans snap token for payment
- `konfirmasiDanPembayaran()` - Updated to redirect to checkout instead of creating transaction directly

**Added Imports:**
- `use Midtrans\Config;`
- `use Midtrans\Snap;`

**Flow:**
1. User confirms contract → Creates Kontrak record
2. Redirects to checkout page
3. User clicks "Pay Now" → Generates Midtrans snap token
4. User completes payment → Transaction status updated
5. Redirect to chat or transaction history

### 4. **Routes** ✅
- **File**: `routes/web.php`

**New Routes:**
```php
Route::get('/contract/checkout/{contract}', [KontrakTrainerController::class, 'checkoutView'])
    ->name('contract.checkout');
    
Route::post('/contract/checkout/generate-payment', [KontrakTrainerController::class, 'generatePayment'])
    ->name('contract.generate-payment');
```

### 5. **Transaksi Model** ✅
- **File**: `app/Models/Transaksi.php`
- Already updated with `id_kontrak` in fillable array

## Payment Flow

```
1. Member views trainer
        ↓
2. Clicks "Contract" button
        ↓
3. Form filled (auto 1 month, auto date)
        ↓
4. Clicks "Confirm Contract"
        ↓
5. Kontrak created → Redirects to checkout
        ↓
6. Shows contract_checkout.blade.php with payment form
        ↓
7. User clicks "Pay Now"
        ↓
8. generatePayment() creates Transaction (status: pending)
        ↓
9. Midtrans snap token generated
        ↓
10. Midtrans payment window opens
        ↓
11. User completes payment (success/pending/error)
        ↓
12. Webhook updates transaction status
        ↓
13. Redirected to chat or transaction history
```

## Features

✅ **Midtrans Integration** - Snap payment gateway with full callbacks
✅ **Order ID** - Generated as: `CONTRACT-{contract_id}-{timestamp}`
✅ **Transaction Record** - Automatically created with pending status
✅ **Item Details** - Shows trainer name and contract info
✅ **Error Handling** - Comprehensive try-catch with logging
✅ **Authorization** - Only contract client can access checkout
✅ **Responsive Design** - Mobile-friendly payment page

## Database Relationships

```
Kontrak
  ├─ id_trainer → Akun (harga_kontrak)
  ├─ id_client → Akun
  └─ Transaksi (one-to-many)

Transaksi
  ├─ id_akun → Akun
  ├─ id_kontrak → Kontrak
  └─ status: pending/completed/failed
```

## Environment Variables Required

```
MIDTRANS_SERVER_KEY=xxx
MIDTRANS_CLIENT_KEY=xxx
```

Already configured in checkout system, reused for contracts.

## Testing Steps

1. Run migration: `php artisan migrate`
2. Set trainer price: `UPDATE akun SET harga_kontrak = 500000 WHERE id = 1;`
3. Login as member
4. Select trainer and create contract
5. Should redirect to checkout page with payment form
6. Click "Pay Now" to test Midtrans payment

## Files Modified

- `app/Http/Controllers/KontrakTrainerController.php` - Added 2 new methods
- `app/Models/Transaksi.php` - Added id_kontrak to fillable
- `routes/web.php` - Added contract checkout routes
- `resources/views/contract_checkout.blade.php` - Created new
- `database/migrations/2025_12_02_000000_add_harga_kontrak_to_akun_table.php` - Created new

## Frontend JavaScript

The contract_checkout.blade.php includes Midtrans Snap JavaScript that:
- Handles "Pay Now" button click
- Calls generatePayment endpoint
- Opens Snap payment popup
- Handles success/pending/error/close callbacks
- Redirects appropriately after payment

## Notes

- Contract is created BEFORE payment (status pending)
- Transaction is created DURING payment generation (status pending)
- ChatRoom is auto-created when Kontrak is created (if model has this feature)
- Payment gateway uses sandbox environment for testing
