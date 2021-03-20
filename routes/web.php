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
Route::get('/products/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.delete');

// ====== suppliers Routes =========//
Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers');
Route::post('/suppliers/add', [App\Http\Controllers\SupplierController::class, 'addSupplier'])->name('suppliers.add');
Route::post('/suppliers/update', [App\Http\Controllers\SupplierController::class, 'editSupplier'])->name('suppliers.edit');
Route::get('/suppliers/get', [App\Http\Controllers\SupplierController::class, 'getSuppliers'])->name('suppliers.get');
Route::get('/suppliers/delete/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('suppliers.delete');

// ====== orders Routes =========//
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders');
Route::post('/orders/add', [App\Http\Controllers\OrderController::class, 'addOrder'])->name('orders.add');
Route::post('/orders/update', [App\Http\Controllers\OrderController::class, 'editOrder'])->name('orders.edit');
Route::get('/orders/get', [App\Http\Controllers\OrderController::class, 'getOrders'])->name('orders.get');
Route::get('/orders/get_all', [App\Http\Controllers\OrderController::class, 'getAllOrders'])->name('orders.get');
Route::get('/orders/delete/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.delete');