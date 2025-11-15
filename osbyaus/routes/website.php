<?php

use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProductController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');


// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
// Optional: Category-based product listing
Route::get('/category/{slug}', [ProductController::class, 'categoryProducts'])->name('category.products');


Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');


// Debug route
Route::get('/debug-products', function(Request $request) {
    Log::info('Debug Products Request:', $request->all());
    return response()->json([
        'request_data' => $request->all(),
        'message' => 'Debug endpoint working'
    ]);
});

