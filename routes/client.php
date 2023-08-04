<?php

use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\client\DetailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ProductClientController;




Route::get('/', [ProductClientController::class, 'index'])->name('route.home.page');
Route::get('/product/detail/{id}',[DetailController::class, 'detail'])->name('route.detail');

Route::get('/my-cart',[CartController::class,'index'])->name('route.myCart');
Route::post('/save-cart', [CartController::class, 'saveCart'])->name('save.cart');


Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout');

Route::post('/payment', [PaymentController::class,'createPayment'])->name('payment.create');
Route::get('/payment/callback', [PaymentController::class,'handlePaymentCallback'])->name('payment.callback');

Route::get('/account',[OrderController::class,'index'])->name('account');

