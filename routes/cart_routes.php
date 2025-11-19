<?php

use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use Illuminate\Support\Facades\Route;

// Cart Routes
Route::prefix('cart')->group(function () {
    // Existing routes
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/sidebar', [CartController::class, 'sidebar'])->name('cart.sidebar');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('cart.get-count');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/add-custom-size', [CartController::class, 'addCustomSizeToCart'])->name('cart.add-custom-size');

    // Cart Page Specific Routes
    Route::put('/page/update', [CartController::class, 'updateCart'])->name('cart.page.update');
    Route::delete('/page/remove/{cartItemId}', [CartController::class, 'removeItemPage'])->name('cart.page.remove');
    Route::delete('/page/clear', [CartController::class, 'clearCartPage'])->name('cart.page.clear');
    Route::get('/page/items', [CartController::class, 'getCartPageItems'])->name('cart.page.items');

    // Existing routes (keep for backward compatibility)
    Route::put('/update/{cartItemId}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/remove/{cartItemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/items', [CartController::class, 'getCartItems'])->name('cart.items');
    //cart page login customer
    Route::post('/login', [CartController::class, 'login'])->name('cart.login');
});


// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
// Stripe Checkout Routes
Route::get('/checkout/stripe/success', [CheckoutController::class, 'success'])->name('checkout.stripe.success');
Route::get('/checkout/stripe/cancel', [CheckoutController::class, 'cancel'])->name('checkout.stripe.cancel');
// Stripe Webhook
Route::post('/stripe/webhook', [CheckoutController::class, 'handleWebhook'])->name('stripe.webhook');
