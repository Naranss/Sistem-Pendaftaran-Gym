<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\SuplemenController;

// Guest Routes
Route::get('/', function () {
    return view('pages.homepage');
})->name('homepage');

Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/suplemen', [SuplemenController::class, 'index'])->name('suplemen');
    Route::get('/trainer', function() { return view('pages.guest.trainer'); })->name('trainer');
    Route::get('/jadwal', function() { return view('pages.guest.jadwal'); })->name('jadwal');
    Route::get('/price', function() { return view('pages.guest.price'); })->name('price');
    Route::get('/about', function() { return view('pages.guest.about'); })->name('about');
});

// Language Switch
Route::post('/lang', function (\Illuminate\Http\Request $request) {
    $locale = $request->input('locale');
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Auth Routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/suplemen', [AdminController::class, 'suplemen'])->name('suplemen');
    Route::get('/alat-gym', [AdminController::class, 'alatGym'])->name('alat-gym');
    Route::get('/akun', [AdminController::class, 'akun'])->name('akun');
    Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('transaksi');
});

// Trainer Routes
Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/jadwal', [TrainerController::class, 'jadwal'])->name('jadwal');
});

// Member Routes
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/suplemen', [MemberController::class, 'suplemen'])->name('suplemen');
    Route::get('/trainer', [MemberController::class, 'trainer'])->name('trainer');
    Route::get('/jadwal', [MemberController::class, 'jadwal'])->name('jadwal');
    Route::get('/membership', [MemberController::class, 'membership'])->name('membership');
    Route::get('/transaksi', [MemberController::class, 'transaksi'])->name('transaksi');
});
