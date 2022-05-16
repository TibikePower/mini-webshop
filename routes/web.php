<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [ProductController::class, 'show'])->middleware(['auth'])->name('dashboard');
Route::get('dashboard', [ProductController::class, 'show'])->middleware(['auth'])->name('dashboard');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->middleware(['auth'])->name('add.to.cart');
Route::get('cart', [CartController::class, 'cart'])->middleware(['auth'])->name('cart');
Route::get('orders', [OrderController::class, 'orders'])->middleware(['auth'])->name('orders');

Route::post('dashboard', [ProductController::class, 'search'])->middleware(['auth'])->name('search');

Route::delete('remove-from-cart', [CartController::class, 'remove'])->middleware(['auth'])->name('remove.from.cart');
Route::patch('update-cart', [CartController::class, 'update'])->middleware(['auth'])->name('update.cart');
Route::get('checkout', [OrderController::class, 'checkout'])->middleware(['auth'])->name('checkout');

Route::patch('delete-order', [OrderController::class, 'delete'])->middleware(['auth'])->name('delete.order');

require __DIR__.'/auth.php';
