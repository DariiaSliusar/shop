<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('shop');
});

Route::get('/shop',[ProductController::class, 'index'])->name('shop');
Route::get('/login-as/{id}', [AuthController::class, 'loginAs'])->name('login-as');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/cart/add/{product}', [CartController::class, 'addProduct'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
