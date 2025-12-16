<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatatTransaksiController;
use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\KelolaAlatGymController;
use App\Http\Controllers\KelolaSuplemenController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PerbaruiJadwalController;
use App\Http\Controllers\PerbaruiMembershipController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\SuplemenController;
use Database\Seeders\AlatGymSeeder;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KontrakTrainerController;

Route::get('/', function () {
    return view('pages.homepage');
})->name('homepage');

Route::get('/suplemen', [SuplemenController::class, 'index'])->name('suplemen');
Route::get('/suplemen/{supplement}', [SuplemenController::class, 'show'])->name('suplemen.show');
Route::post('/suplemen/add-to-cart', [SuplemenController::class, 'addToCart'])->name('suplemen.addToCart')->middleware('auth');

Route::group(['middleware' => ['guest', 'auth'], 'prefix' => 'guest', 'name' => 'guest.'], function () {
    Route::get('/suplemen', [SuplemenController::class, 'index'])->name('suplemen');
    Route::get('/trainer', [KontrakTrainerController::class, 'index'])->name('trainer');
    Route::get('/trainer/{trainer}', [KontrakTrainerController::class, 'show'])->name('trainer.contract');
    Route::post('/trainer/{trainer}/contract', [KontrakTrainerController::class, 'store'])->name('trainer.contract.store');
    Route::get('/jadwal', function () {
        return view('pages.guest.jadwal');
    })->name('jadwal');
    Route::get('/price', function () {
        return view('pages.guest.price');
    })->name('price');
    Route::get('/transaction', function () {
        return view('pages.guest.riwayat_transaksi');
    })->name('transaction');
});

// Language Switch
Route::post('/lang', function (\Illuminate\Http\Request $request) {
    $locale = $request->input('locale');
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch.post');


// Auth Routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Auth route
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/generate-payment', [CheckoutController::class, 'generatePayment'])->name('checkout.generate-payment');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.room.index');
    Route::get('/chat/{room}', [ChatController::class, 'show'])->name('chat.room.show');
    Route::post('/chat/{room}/send', [ChatController::class, 'send'])->name('chat.room.send');
    Route::get('/chat/{room}/messages', [ChatController::class, 'getMessages'])->name('chat.api.messages');
    Route::get('/jadwal', [PerbaruiJadwalController::class, 'client'])->name('auth.jadwal');
    Route::get('/trainer', [KontrakTrainerController::class, 'index'])->name('my.trainer');
    
    // Contract Checkout Routes
    Route::get('/contract/checkout/{contract}', [KontrakTrainerController::class, 'checkoutView'])->name('contract.checkout');
    Route::post('/contract/checkout/generate-payment', [KontrakTrainerController::class, 'generatePayment'])->name('contract.generate-payment');
    Route::post('/contract/confirm-payment', [KontrakTrainerController::class, 'confirmPayment'])->name('contract.confirm-payment');
    Route::get('/membership/payment', [MemberController::class, 'membershipPayment'])->name('membership.payment');
    Route::post('/membership/confirm-payment', [MemberController::class, 'confirmMembershipPayment'])->name('membership.confirm-payment');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Midtrans Payment Routes
    Route::post('/cart/pay', [\App\Http\Controllers\PaymentController::class, 'pay'])->middleware('auth')->name('cart.pay');
});

// Guest Routes (authenticated users without MEMBER role)
Route::group(['middleware' => ['auth'], 'prefix' => 'guest', 'as' => 'guest.'], function () {
    Route::get('/trainer', [KontrakTrainerController::class, 'index'])->name('trainer');
    Route::get('/trainer/{trainer}/contract', [KontrakTrainerController::class, 'show'])->name('trainer.contract');
    Route::post('/trainer/{trainer}/contract/store', [KontrakTrainerController::class, 'store'])->name('trainer.contract.store');
    Route::get('/jadwal', [PerbaruiJadwalController::class, 'client'])->name('jadwal');
    Route::get('/membership', [MemberController::class, 'membership'])->name('membership');
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'daftarTransaksiPengguna'])->name('riwayat');
    Route::get('/transaction/{transaction}/pay', [RiwayatTransaksiController::class, 'payTransaction'])->name('transaction.pay');
    Route::get('/transaction/{transaction}/details', [RiwayatTransaksiController::class, 'showDetails'])->name('transaction.details');
});

// Member Routes
Route::group(['middleware' => ['member', 'auth'], 'prefix' => 'member', 'as' => 'member.'], function () {
    Route::get('/trainer', [KontrakTrainerController::class, 'index'])->name('trainer');
    Route::get('/jadwal', [PerbaruiJadwalController::class, 'client'])->name('jadwal');
    Route::get('/membership', [MemberController::class, 'membership'])->name('membership');
    Route::post('/membership/update', [MemberController::class, 'updateMembership'])->name('membership.update');
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'daftarTransaksiPengguna'])->name('riwayat');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.room.index');
    Route::get('/chat/{room}', [ChatController::class, 'show'])->name('chat.room.show');
    Route::post('/chat/{room}/send', [ChatController::class, 'send'])->name('chat.room.send');
    Route::get('/chat/{room}/messages', [ChatController::class, 'getMessages'])->name('chat.api.messages');
    Route::get('/transaction/{transaction}/pay', [RiwayatTransaksiController::class, 'payTransaction'])->name('transaction.pay');
    Route::get('/transaction/{transaction}/details', [RiwayatTransaksiController::class, 'showDetails'])->name('transaction.details');
});

// Admin Routes
Route::group(['middleware' => ['admin', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/suplemen', [KelolaSuplemenController::class, 'index'])->name('suplemen');
    Route::get('/suplemen/{id}', [KelolaSuplemenController::class, 'show'])->name('suplemen.show');
    Route::post('/suplemen', [KelolaSuplemenController::class, 'store'])->name('suplemen.store');
    Route::put('/suplemen/{id}', [KelolaSuplemenController::class, 'update'])->name('suplemen.update');
    Route::delete('/suplemen/{id}', [KelolaSuplemenController::class, 'destroy'])->name('suplemen.destroy');
    Route::get('/alat-gym', [KelolaAlatGymController::class, 'index'])->name('alat-gym');
    Route::post('/alat-gym', [KelolaAlatGymController::class, 'store'])->name('alat-gym.store');
    Route::put('/alat-gym/{id}', [KelolaAlatGymController::class, 'update'])->name('alat-gym.update');
    Route::delete('/alat-gym/{id}', [KelolaAlatGymController::class, 'destroy'])->name('alat-gym.destroy');
    Route::get('/akun', [KelolaAkunController::class, 'index'])->name('akun');
    Route::post('/akun', [KelolaAkunController::class, 'store'])->name('akun.store');
    Route::put('/akun/{id}', [KelolaAkunController::class, 'update'])->name('akun.update');
    Route::delete('/akun/{id}', [KelolaAkunController::class, 'destroy'])->name('akun.destroy');
    Route::get('/transaksi', [CatatTransaksiController::class, 'index'])->name('transaksi');
    Route::post('/transaksi', [CatatTransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{transaksi}', [CatatTransaksiController::class, 'show'])->name('transaksi.show');
});

// Broadcasting Authentication
Route::post('/broadcasting/auth', function () {
    return \Illuminate\Support\Facades\Auth::user();
})->middleware('auth');

// Trainer Routes
Route::group(['middleware' => ['trainer', 'auth'], 'prefix' => 'trainer', 'as' => 'trainer.'], function () {
    Route::get('/jadwal', [KontrakTrainerController::class, 'scheduleList'])->name('jadwal');
    Route::get('/clients', [KontrakTrainerController::class, 'memberList'])->name('clients');
    // Edit client/contract form for trainers
    Route::get('/clients/{contract}/edit', [PerbaruiJadwalController::class, 'edit'])->name('clients.edit');
    // Update jadwal (form from pages.trainer.jadwal.blade.php posts to this named route)
    Route::post('/jadwal/update', [PerbaruiJadwalController::class, 'update'])->name('jadwal.update');
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.room.index');
    Route::get('/chat/{room}', [ChatController::class, 'show'])->name('chat.room.show');
    Route::post('/chat/{room}/send', [ChatController::class, 'send'])->name('chat.room.send');
    Route::get('/chat/{room}/messages', [ChatController::class, 'getMessages'])->name('chat.api.messages');
});
