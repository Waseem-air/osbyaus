<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // 🧾 Admin Dashboard Routes
    Route::get('/transaction', [AdminController::class, 'transaction'])->name('transaction');
    Route::get('/store-menu', [AdminController::class, 'store_menu'])->name('store.menu');

    // 🏷️ Category Routes
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'category_list'])->name('index');
        Route::get('/{id}/show', [CategoryController::class, 'show_category'])->name('show');
        Route::post('/store', [CategoryController::class, 'store_category'])->name('store');
        Route::get('/{id}/get', [CategoryController::class, 'get_category'])->name('get');
        Route::post('/{id}/update', [CategoryController::class, 'update_category'])->name('update');
        Route::delete('/{id}/delete', [CategoryController::class, 'delete_category'])->name('delete');
    });

    // 🛒 Product Routes
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'product_list'])->name('index');
        Route::get('/add', [ProductController::class, 'add_product'])->name('add');
        Route::post('/store', [ProductController::class, 'store_product'])->name('store');
        Route::get('/{id}/show', [ProductController::class, 'show_product'])->name('show');
        Route::get('/{id}/get', [ProductController::class, 'get_product'])->name('get');
        Route::post('/{id}/update', [ProductController::class, 'update_product'])->name('update');
        Route::delete('/{id}/delete', [ProductController::class, 'delete_product'])->name('delete');
    });

});
