<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'showIndex'])->name('index');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/cart', [ProductController::class, 'showCart'])->name('cart');
Route::post('/add', [ProductController::class, 'addToCart']);
Route::post('/remove', [ProductController::class, 'removeFromCart']);

Route::get('/products', [ProductController::class, 'showAll'])->middleware(['auth'])->name('products');
Route::post('/product/delete', [ProductController::class, 'deleteProduct'])->middleware(['auth']);
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->middleware(['auth'])->name('product-edit');
Route::post('/product/update', [ProductController::class, 'update'])->middleware(['auth'])->name('product-update');
Route::get('/product/add',
    [ProductController::class, 'addProduct'])->middleware(['auth'])->name('add-product-page');
Route::post('/product/create',
    [ProductController::class, 'createProduct'])->middleware(['auth'])->name('create-product');

Route::get('/order/{id}', [OrderController::class, 'showOrder'])->middleware(['auth'])->name('order');
Route::get('/orders', [OrderController::class, 'showOrders'])->middleware(['auth'])->name('orders');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';
