<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Midtrans Payment Callback (No CSRF needed - server-to-server)
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('api.midtrans.callback');
