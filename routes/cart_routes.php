<?php

use App\Http\Controllers\Website\CartController;
use Illuminate\Support\Facades\Route;

// Cart Routes

// Cart Routes
Route::prefix('cart')->group(function () {
    // Existing routes
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/sidebar', [CartController::class, 'sidebar'])->name('cart.sidebar');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('cart.get-count');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/add-custom-size', [CartController::class, 'addCustomSizeToCart'])->name('cart.add-custom-size');

    // Cart Page Specific Routes - Fix parameter names
    Route::put('/page/update-quantity/{cartItemId}', [CartController::class, 'updateQuantityPage'])->name('cart.page.update-quantity');
    Route::delete('/page/remove/{cartItemId}', [CartController::class, 'removeItemPage'])->name('cart.page.remove');
    Route::delete('/page/clear', [CartController::class, 'clearCartPage'])->name('cart.page.clear');
    Route::get('/page/items', [CartController::class, 'getCartPageItems'])->name('cart.page.items');

    // Existing routes (keep for backward compatibility)
    Route::put('/update/{cartItemId}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/remove/{cartItemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/items', [CartController::class, 'getCartItems'])->name('cart.items');
});

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware(['auth', 'role:customer'])
    ->name('checkout');
