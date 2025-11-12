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
    Route::get('/categories', [CategoryController::class, 'category_list'])->name('category.list');
    Route::post('/categories/store', [CategoryController::class, 'store_category'])->name('category.store');
    Route::get('/categories/{id}/get', [CategoryController::class, 'get_category'])->name('category.get');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update_category'])->name('category.update');
    Route::delete('/categories/{id}/delete', [CategoryController::class, 'delete_category'])->name('category.delete');

});
