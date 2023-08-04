<?php

use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\DetailController;
use App\Http\Controllers\client\OrderController;
use App\Http\Controllers\client\PaymentController;
use App\Http\Controllers\client\ProductClientController;
use Illuminate\Support\Facades\Route;

Route::post('/addSession/{id}',[DetailController::class, 'addSession'])->name('route.addSession');
Route::get('/detail/{id}',[DetailController::class, 'viewDetail'])->name('route.viewDetail');
Route::get('/', [ProductClientController::class, 'index'])->name('route.home.page');
Route::get('/product/detail/{id}',[DetailController::class, 'detail'])->name('route.detail');


Route::get('/view-cart-table',[CartController::class,'valueTable'])->name('route.loadTable');
Route::get('/view-cart',[CartController::class,'index'])->name('route.viewCart');
Route::get('/my-cart',[CartController::class,'index'])->name('route.myCart');
Route::post('/save-cart', [CartController::class, 'saveCart'])->name('save.cart');
//Route::get('/detail-product',[CartController::class,'index'])->name('route.detail');

Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout');

Route::post('/payment', [PaymentController::class,'createPayment'])->name('payment.create');
Route::get('/payment/callback', [PaymentController::class,'handlePaymentCallback'])->name('payment.callback');

Route::get('/account',[OrderController::class,'index'])->name('account');

