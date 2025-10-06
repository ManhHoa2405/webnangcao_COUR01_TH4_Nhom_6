<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Thêm dòng này để xóa
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

