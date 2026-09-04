<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CMSController;

/*
|--------------------------------------------------------------------------
| Web Routes - Monolithic Laravel Application
|--------------------------------------------------------------------------
*/

// Public Storefront Routes
Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/catalog', [StorefrontController::class, 'catalog'])->name('catalog');
Route::get('/categories', [StorefrontController::class, 'categories'])->name('categories');
Route::get('/product/{id}', [StorefrontController::class, 'productDetail'])->name('product.detail');
Route::get('/checkout', [StorefrontController::class, 'checkout'])->name('checkout');
Route::get('/wishlist', [StorefrontController::class, 'wishlist'])->name('wishlist');
Route::get('/order-success/{orderId}', [StorefrontController::class, 'orderSuccess'])->name('order.success');
Route::get('/order-tracking', [StorefrontController::class, 'orderTracking'])->name('order.tracking');

// Static Pages
Route::get('/help', [StorefrontController::class, 'help'])->name('page.help');
Route::get('/how-to-order', [StorefrontController::class, 'howToOrder'])->name('page.how-to-order');
Route::get('/shipping-delivery', [StorefrontController::class, 'shipping'])->name('page.shipping');
Route::get('/returns-refunds', [StorefrontController::class, 'returns'])->name('page.returns');
Route::get('/privacy-policy', [StorefrontController::class, 'privacy'])->name('page.privacy');
Route::get('/terms-conditions', [StorefrontController::class, 'terms'])->name('page.terms');

// Admin Authentication
Route::get('/admin/login', [AdminViewController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminViewController::class, 'handleLogin'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminViewController::class, 'logout'])->name('admin.logout');
Route::post('/admin/logout', [AdminViewController::class, 'logout'])->name('admin.logout.post');

// Admin Protected Dashboard & CMS Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminViewController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminViewController::class, 'products'])->name('admin.products');
    Route::get('/categories', [AdminViewController::class, 'categories'])->name('admin.categories');
    Route::get('/orders', [AdminViewController::class, 'orders'])->name('admin.orders');
    Route::get('/coupons', [AdminViewController::class, 'coupons'])->name('admin.coupons');
    Route::get('/customers', [AdminViewController::class, 'customers'])->name('admin.customers');
    Route::get('/cms', [AdminViewController::class, 'cms'])->name('admin.cms');
    Route::get('/integrations', [AdminViewController::class, 'integrations'])->name('admin.integrations');
    Route::get('/audit-logs', [AdminViewController::class, 'auditLogs'])->name('admin.audit-logs');
});
