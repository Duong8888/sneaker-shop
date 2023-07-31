<?php

use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\PaymentController;
use App\Http\Controllers\client\ProductClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductClientController::class, 'index'])->name('user');
Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout');

Route::post('/payment', [PaymentController::class,'createPayment'])->name('payment.create');
Route::get('/payment/callback', [PaymentController::class,'handlePaymentCallback'])->name('payment.callback');

Route::get('/account',[OrderController::class,'index'])->name('account');
