<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\client\DetailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ProductClientController;


//Route::get('/', [ProductClientController::class, 'index'])->name('user');

Route::get('/', [ProductClientController::class, 'index'])->name('route.home.page');
Route::get('/product/detail/{id}',[DetailController::class, 'detail'])->name('route.detail');


// e ấn giữ ctrl rồi clcik là nó nhảy dênd

Route::get('/my-cart',[CartController::class,'index'])->name('route.myCart');
Route::post('/save-cart', [CartController::class, 'saveCart'])->name('save.cart');
