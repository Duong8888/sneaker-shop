<?php

use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\client\DetailProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ProductClientController;


Route::get('/', [ProductClientController::class, 'index'])->name('route.home.page');
Route::get('/product/detail/{id}', [DetailProductController::class, 'detail'])->name('route.detail');

Route::get('/my-cart', [CartController::class, 'index'])->name('route.myCart');
Route::post('/save-cart', [CartController::class, 'saveCart'])->name('save.cart');

Route::group(['prefix' => 'checkout', 'as'=>'checkout.','middleware' => 'auth'], function () {
    Route::get('/', [PaymentController::class, 'showCheckout'])->name('checkout');
    Route::post('/order-detail', [OrderController::class, 'detailOrder'])->name('order.detail');
    Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/callback', [PaymentController::class, 'handlePaymentCallback'])->name('payment.callback');

    Route::post('/payment/refund', [PaymentController::class, 'refund'])->name('payment.refund');
});
Route::get('/account', [OrderController::class, 'index'])->name('account');

