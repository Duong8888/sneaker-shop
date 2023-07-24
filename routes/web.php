<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\product\ProductController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\TrashBrandController;
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

Route::get('/', function () {
    return view('welcome');
})->name('admin');

//Route::get('/', function () {
//    return view('admin.authen.login');
//});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('list', [ProductController::class, 'list'])->name('list');
    Route::match(['GET', 'POST'], 'add', [ProductController::class, 'add'])->name('add');
    Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    Route::get('edit/{id}', [ProductController::class, 'showEdit'])->name('show.edit');
    Route::post('edit/{id}', [ProductController::class, 'saveEdit'])->name('edit');
});

Route::group(['prefix' => 'color', 'as' => 'color.', 'auth', 'verified'], function () {
    Route::get('/', [ColorController::class, 'index'])->name('index');
    Route::get('/delete/{id}', [ColorController::class, 'delete'])->name('delete');
    Route::match(['GET', 'POST'], 'add', [ColorController::class, 'add'])->name('add');
});
Route::group(['prefix' => 'size', 'as' => 'size.'], function () {
    Route::get('/delete/{id}', [SizeController::class, 'delete'])->name('delete');
    Route::match(['GET', 'POST'], 'add', [SizeController::class, 'add'])->name('add');
});


Route::get('/brands/list', [BrandsController::class, 'list'])->name('route.brands.list');
Route::match(['GET', 'POST'], '/brands/add', [BrandsController::class, 'add'])->name('route.brands.add');
Route::match(['GET', 'POST'], '/brands/edit/{id}', [BrandsController::class, 'edit'])->name('route.brands.edit');
Route::get('/brands/delete/{id}', [BrandsController::class, 'delete'])->name('route.brands.delete');


//Route::match(['GET','POST'],'/auth/login',[AuthenController::class,'login'])->name('route.auth.login');
//Route::match(['GET','POST'],'/auth/register',[AuthenController::class,'register'])->name('route.auth.register');


Route::get('/trash/list', [TrashBrandController::class, 'list'])->name('route.brands.trash');
Route::post('/brands/restore/{id}', [TrashBrandController::class, 'restore'])->name('route.brands.restore');
Route::post('/brands/delete/{id}', [TrashBrandController::class, 'delete'])->name('route.brands.delete');




//require __DIR__.'/auth.php';
