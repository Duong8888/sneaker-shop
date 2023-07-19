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

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('list', [ProductController::class, 'list'])->name('list');
    Route::match(['GET', 'POST'], 'add', [ProductController::class, 'add'])->name('add');
    Route::match(['GET', 'POST'], 'edit/{id}', [ProductController::class, 'edit'])->name('edit');
});

Route::group(['prefix' => 'color', 'as' => 'color.'], function () {
    Route::match(['GET', 'POST'], 'add', [ColorController::class, 'add'])->name('add');
});
Route::group(['prefix' => 'size', 'as' => 'size.'], function () {
    Route::match(['GET', 'POST'], 'add', [SizeController::class, 'add'])->name('add');
});


Route::get('/', function (){return view('admin.index');})->name('admin');



Route::get('/brands/list', [BrandsController::class, 'list'])->name('route.brands.list');
Route::match(['GET', 'POST'], '/brands/add', [BrandsController::class, 'add'])->name('route.brands.add');
Route::match(['GET', 'POST'], '/brands/edit/{id}', [BrandsController::class, 'edit'])->name('route.brands.edit');


Route::match(['GET','POST'],'/auth/login',[AuthenController::class,'login'])->name('route.auth.login');
Route::match(['GET','POST'],'/auth/register',[AuthenController::class,'register'])->name('route.auth.register');



