<?php

use App\Http\Controllers\Website\CartController;
use Illuminate\Support\Facades\Route;


// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/sidebar', [CartController::class, 'sidebar'])->name('cart.sidebar');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('cart.get-count');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/add-custom-size', [CartController::class, 'addCustomSizeToCart'])->name('cart.add-custom-size');
    Route::put('/update/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/items', [CartController::class, 'getCartItems'])->name('cart.items');
});


Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware(['auth', 'role:customer'])
    ->name('checkout');
