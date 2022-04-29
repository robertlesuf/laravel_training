<?php

use App\Http\Controllers\AuthAjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Auth;
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

//Route::get('/', [HomeController::class, 'index'])->name('index');

Auth::routes();

Route::resource('products', ProductController::class)->middleware('auth')->except(['show']);

Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);

Route::resource('orders', OrderController::class)->only(['index', 'show', 'store']);

Route::post('/login/token', [AuthAjaxController::class, 'tokenAuth']);

Route::get('/status', [AuthAjaxController::class, 'returnStatus']);

Route::get('/regenerate', [AuthAjaxController::class, 'returnToken']);

Route::get('/', [SpaController::class, 'index']);
