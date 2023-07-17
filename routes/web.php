<?php



use App\Http\Controllers\Admin\product\ProductController;

use App\Http\Controllers\Admin\AuthenController;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\color\ColorController;
use App\Http\Controllers\Admin\size\SizeController;


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




Route::get('/', [ProductController::class, 'index'])->name('admin');


Route::get('/brands/list', [BrandsController::class, 'list'])->name('route.brands.list');
Route::match(['GET', 'POST'], '/brands/add', [BrandsController::class, 'add'])->name('route.brands.add');
Route::match(['GET', 'POST'], '/brands/edit/{id}', [BrandsController::class, 'edit'])->name('route.brands.edit');


Route::match(['GET','POST'],'/auth/login',[AuthenController::class,'login'])->name('route.auth.login');
Route::match(['GET','POST'],'/auth/register',[AuthenController::class,'register'])->name('route.auth.register');



