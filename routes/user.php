<?php

use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // show order detail
    Route::get('/order/{order_number}', [OrderController::class, 'show'])->name('user.order.show')->middleware('auth');
    // index
    Route::get('/orders', [OrderController::class, 'index'])->name('user.order.index')->middleware('auth');
});
