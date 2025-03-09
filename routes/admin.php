<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// group routes with admin middleware
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    // Auth routes
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('/system')->group(function () {
        // settings option
        Route::resource('/settings', SettingsController::class);
        Route::resource('/countries', CountryController::class);
        Route::post('/countries/change-status', [CountryController::class, 'changeStatus'])->name('countries.change-status');
        Route::resource('/states', StateController::class);
        // php info
        Route::get('/phpinfo', function () {
            return view('phpinfo', [
                'title' => 'PHP Info',
            ]);
        })->name('phpinfo');

        // products option
        Route::resource('/products', ProductController::class);
        Route::post('/products/remove-gallery-image', [ProductController::class, 'removeGalleryImage'])->name('remove.image');
        Route::resource('/product/categories', CategoryController::class);
        Route::resource('/product/tags', TagController::class);
        Route::resource('/product/vendors', VendorController::class);

        Route::resource('/banners', BannerController::class);
        Route::resource('/users', UserController::class);
        Route::get('/wholesaler', [UserController::class, 'distributors'])->name('distributors.index');

        Route::resource('/coupons', CouponController::class);

    });

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/update-status', [AdminOrderController::class, 'updateStatus'])->name('order.update.status');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('order.show');
    Route::get('/recent-orders', [AdminOrderController::class, 'recentOrders'])->name('orders.recent');

});
