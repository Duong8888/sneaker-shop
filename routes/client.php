<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ProductClientController;


Route::get('/', [ProductClientController::class, 'index'])->name('user');
Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout');
