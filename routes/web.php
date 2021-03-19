<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ====== Products Routes =========//
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::post('/products/add', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('products.add');
Route::post('/products/update', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('products.edit');
Route::get('/products/get', [App\Http\Controllers\ProductController::class, 'getProducts'])->name('products.get');