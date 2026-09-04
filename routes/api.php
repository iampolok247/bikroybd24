<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\WhatsAppWebhookController;
use App\Http\Controllers\Api\LiveChatController;

// Health Check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ONLINE',
        'service' => 'BikroyBD24 Laravel REST API',
        'timestamp' => now()->toIso8601String()
    ]);
});

// Auth Routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Category Routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);

// Product Routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// CMS Content Routes
Route::get('/cms', [CMSController::class, 'index']);
Route::post('/cms', [CMSController::class, 'store']);
Route::get('/cms/{key}', [CMSController::class, 'show']);
Route::post('/cms/{key}', [CMSController::class, 'storeKey']);

// Coupon Routes
Route::get('/coupons', [CouponController::class, 'index']);
Route::post('/coupons', [CouponController::class, 'store']);
Route::post('/coupons/apply', [CouponController::class, 'apply']);

// Order Routes
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);

// Admin Stats
Route::get('/admin/stats', [AdminController::class, 'stats']);

// WhatsApp Webhook Routes
Route::match(['get', 'post'], '/whatsapp-webhook', [WhatsAppWebhookController::class, 'handle']);

// Native Website Live Chat AI Routes
Route::get('/live-chat/config', [LiveChatController::class, 'getConfig']);
Route::post('/live-chat/message', [LiveChatController::class, 'sendMessage']);



