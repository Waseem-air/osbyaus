<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // 🧾 Admin Dashboard Routes
    Route::get('/transaction', [AdminController::class, 'transaction'])->name('transaction');
    Route::get('/store-menu', [AdminController::class, 'store_menu'])->name('store.menu');

    // 🛒 Product Routes
    Route::get('/add-product', [ProductController::class, 'add_product'])->name('add.product');
    Route::get('/product-list', [ProductController::class, 'product_list'])->name('product.list');

    // 🏷️ Category Routes
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'category_list'])->name('index');
        Route::get('/{id}/show', [CategoryController::class, 'show_category'])->name('show');
        Route::post('/store', [CategoryController::class, 'store_category'])->name('store');
        Route::get('/{id}/get', [CategoryController::class, 'get_category'])->name('get');
        Route::post('/{id}/update', [CategoryController::class, 'update_category'])->name('update');
        Route::delete('/{id}/delete', [CategoryController::class, 'delete_category'])->name('delete');
    });
});
