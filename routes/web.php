<?php

use App\Http\Controllers\CacheController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DistributorController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShippingController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/delivery-information', [PageController::class, 'deliveryInformation'])->name('delivery.information');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-of-service', [PageController::class, 'termsOfService'])->name('terms.of.service');
Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('return.policy');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact');

// cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
// checkout
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
// submit order
Route::post('/cart/checkout', [CartController::class, 'submitOrder'])->name('submit.order')->middleware('auth');

Route::any('order/{order_number}/payment', [CartController::class, 'submitOrder'])->name('order.payment')->middleware('auth');

// success, cancel, failed
Route::get('/order/success', [CartController::class, 'orderSuccess'])->name('order.success');
Route::get('/order/cancel', [CartController::class, 'orderCancel'])->name('order.cancel');
Route::get('/order/failed', [CartController::class, 'orderFailed'])->name('order.failed');

// show product on modal
Route::post('/quick-view', [ProductController::class, 'quickView'])->name('quick.view');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');

// product search
Route::get('/products/search', [ProductController::class, 'searchView'])->name('search.results');
Route::post('/products/search', [ProductController::class, 'search'])->name('api.products.search');

Route::get('/collection/{slug}', [ProductController::class, 'categoryProducts'])->name('category.products');
Route::get('/collection/{category_slug}/product/{slug}', [ProductController::class, 'productDetail'])->name('product.detail');

Route::get('/tag/{slug}', [ProductController::class, 'tagProducts'])->name('tag.products');

Route::post('/verify-address', [AddressController::class, 'verify'])->name('verify.address');
Route::post('/shipping/economy-charge', [ShippingController::class, 'calculateEconomyCharge'])->name('shipping.economy.charge');

// vendors
Route::get('/vendors', [PageController::class, 'vendors'])->name('vendors');

// become a wholesaler
Route::get('/become-a-wholesaler', [DistributorController::class, 'becomeDistributor'])->name('become.distributor');
Route::post('/become-a-wholesaler', [DistributorController::class, 'store'])->name('distributor.submit');

Route::get('/image/{path}', function ($path) {
    $path = storage_path('app/public/'.$path);
    if (! file_exists($path)) {
        abort(404);
    }
    $image = Image::make($path);
    // Set a high initial quality (quality will be adjusted if image size > 200KB)
    $image->encode('jpg', 90);

    return $image->response();
})->where('path', '.*');

// sitemap
Route::get('sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
// robots.txt
Route::get('robots.txt', [PageController::class, 'robots'])->name('robots');

// php artisan optimize:clear
Route::get('/clear-cache', [CacheController::class, 'clearCache'])->name('cache.clear');


require __DIR__.'/user.php';
require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
require __DIR__.'/seo.php';
