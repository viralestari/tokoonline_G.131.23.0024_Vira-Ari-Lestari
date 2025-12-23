<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');

/* =======================
        CART ROUTES
======================= */

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

/* =======================
        ORDER ROUTES
======================= */

Route::get('/checkout', [OrderController::class, 'checkout'])
    ->name('order.checkout');

Route::post('/order', [OrderController::class, 'store'])
    ->name('order.store');

Route::get('/order/success/{id}', [OrderController::class, 'success'])
    ->name('order.success');
