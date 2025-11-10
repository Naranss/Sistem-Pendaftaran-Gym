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
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\SuplemenController;
use Database\Seeders\AlatGymSeeder;

// Guest Routes
Route::get('/', function () {
    return view('pages.homepage');
})->name('homepage');

Route::group(['middleware' => ['guest', 'auth'], 'prefix' => 'guest', 'name' => 'guest.'], function () {
    Route::get('/suplemen', [SuplemenController::class, 'index'])->name('suplemen');
    Route::get('/trainer', function () {
        return view('pages.guest.trainer');
    })->name('trainer');
    Route::get('/jadwal', function () {
        return view('pages.guest.jadwal');
    })->name('jadwal');
    Route::get('/price', function () {
        return view('pages.guest.price');
    })->name('price');
    Route::get('/about', function () {
        return view('pages.guest.about');
    })->name('about');
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
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Cart Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Guest Routes
Route::group(['middleware' => ['auth'], 'prefix' => 'guest', 'as' => 'guest.'], function () {
    Route::get('/suplemen', [SuplemenController::class, 'index'])->name('suplemen');
    Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer');
    Route::get('/jadwal', [PerbaruiJadwalController::class, 'dataJadwalDanClient'])->name('jadwal');
    Route::get('/membership', [MemberController::class, 'membership'])->name('membership');
    Route::get('/keranjang', [BayarController::class, 'getKeranjang'])->name('keranjang');
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'daftarTransaksiPengguna'])->name('riwayat');
});

// Member Routes
Route::group(['middleware' => ['member', 'auth'], 'prefix' => 'member', 'as' => 'member.'], function () {
    Route::get('/suplemen', [SuplemenController::class, 'index'])->name('suplemen');
    Route::get('/trainer', [TrainerController::class, 'jadwal'])->name('trainer');
    Route::get('/jadwal', [PerbaruiJadwalController::class, 'client'])->name('jadwal');
    Route::get('/membership', [MemberController::class, 'membership'])->name('membership');
    Route::get('/keranjang', [BayarController::class, 'getKeranjang'])->name('keranjang');
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'daftarTransaksiPengguna'])->name('riwayat');
});

// Admin Routes
Route::group(['middleware' => ['admin', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/suplemen', [KelolaSuplemenController::class, 'index'])->name('suplemen');
    Route::get('/alat-gym', [KelolaAlatGymController::class, 'index'])->name('alat-gym');
    Route::get('/akun', [KelolaAkunController::class, 'index'])->name('akun');
    Route::get('/transaksi', [CatatTransaksiController::class, 'index'])->name('transaksi');
});

// Trainer Routes
Route::group(['middleware' => ['trainer', 'auth'], 'prefix' => 'trainer', 'as' => 'trainer.'], function () {
    Route::get('/jadwal', [PerbaruiJadwalController::class, 'trainer'])->name('jadwal');
    // Edit client/contract form for trainers
    Route::get('/clients/{contract}/edit', [PerbaruiJadwalController::class, 'edit'])->name('clients.edit');
    // Update jadwal (form from pages.trainer.jadwal.blade.php posts to this named route)
    Route::post('/jadwal/update', [PerbaruiJadwalController::class, 'update'])->name('jadwal.update');
});
