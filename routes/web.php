<?php


use App\Http\Controllers\Admin\ProductController;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[ProductController::class, 'index'])->name('admin');
Route::get('/product/list',[ProductController::class, 'list'])->name('route_product_list');
Route::match(['GET','POST'],'/product/add',[ProductController::class, 'add'])->name('route_product_add');
Route::match(['GET','POST'],'/product/edit/{id}',[ProductController::class, 'edit'])->name('route_product_edit');


Route::get('/brands/list',[BrandsController::class, 'list'])->name('route.brands.list');
Route::match(['GET','POST'],'/brands/add',[BrandsController::class, 'add'])->name('route.brands.add');
Route::match(['GET','POST'],'/brands/edit/{id}',[BrandsController::class, 'edit'])->name('route.brands.edit');






