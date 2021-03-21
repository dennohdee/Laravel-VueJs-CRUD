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
Route::get('/products/all', [App\Http\Controllers\ProductController::class, 'getAllProducts'])->name('products.get');
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

// ====== order-details Routes =========//
Route::get('/order-details/{id}-{order}', [App\Http\Controllers\OrderDetailsController::class, 'index'])->name('order-details');
Route::post('/order-details/add', [App\Http\Controllers\OrderDetailsController::class, 'addOrderDetails'])->name('order-details.add');
Route::post('/order-details/update', [App\Http\Controllers\OrderDetailsController::class, 'editOrderDetails'])->name('order-details.edit');
Route::get('/order-details/get/{id}', [App\Http\Controllers\OrderDetailsController::class, 'getOrderDetails'])->name('order-details.get');
Route::get('/order-details/delete/{id}', [App\Http\Controllers\OrderDetailsController::class, 'destroy'])->name('order-details.delete');
Route::get('/order-details/export', [App\Http\Controllers\OrderDetailsController::class, 'ordersExport'])->name('order-details.export');

// ====== supplier-products Routes =========//
Route::get('/supplier-products/{id}-{order}', [App\Http\Controllers\SupplierProductsController::class, 'index'])->name('supplier-products');
Route::post('/supplier-products/add', [App\Http\Controllers\SupplierProductsController::class, 'addSupplierProducts'])->name('supplier-products.add');
Route::post('/supplier-products/update', [App\Http\Controllers\SupplierProductsController::class, 'editSupplierProducts'])->name('supplier-products.edit');
Route::get('/supplier-products/get/{id}', [App\Http\Controllers\SupplierProductsController::class, 'getSupplierProducts'])->name('supplier-products.get');
Route::get('/supplier-products/delete/{id}', [App\Http\Controllers\SupplierProductsController::class, 'destroy'])->name('supplier-products.delete');

// chart data
Route::get('/chart/product-orders', [App\Http\Controllers\ChartController::class, 'getProductOrder'])->name('product-orders.chart');