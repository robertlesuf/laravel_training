<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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
Route::get('/order', [OrderController::class, 'showOrder'])->name('order');
Route::get('/orders', [OrderController::class, 'showOrders'])->middleware(['auth'])->name('orders');
Route::post('/update-product', [ProductController::class, 'update'])->middleware(['auth'])->name('update-product');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/product-edit', [ProductController::class, 'edit'])->middleware(['auth'])->name('product-edit');
Route::get('/cart', [ProductController::class, 'showCart']);
Route::post('/remove-from-cart', [ProductController::class, 'removeFromCart']);
Route::post('/add-to-cart', [ProductController::class, 'addToCart']);;
Route::get('/products', [ProductController::class, 'showAll'])->middleware(['auth'])->name('products');
Route::get('/add-product-page',
    [ProductController::class, 'addProduct'])->middleware(['auth'])->name('add-product-page');
Route::post('/create-product',
    [ProductController::class, 'createProduct'])->middleware(['auth'])->name('create-product');
Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->middleware(['auth']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
