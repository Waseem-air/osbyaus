<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SizeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // 🧾 Admin Dashboard Routes
    Route::get('/transaction', [AdminController::class, 'transaction'])->name('transaction');
    Route::get('/store-menu', [AdminController::class, 'store_menu'])->name('store.menu');

    // Color Routes
    Route::prefix('colors')->name('color.')->group(function () {
        Route::get('/', [ColorController::class, 'color_list'])->name('index');
        Route::post('/store', [ColorController::class, 'store_color'])->name('store');
        Route::get('/{id}/get', [ColorController::class, 'get_color'])->name('get');
        Route::post('/{id}/update', [ColorController::class, 'update_color'])->name('update');
        Route::post('/{id}/toggle-status', [ColorController::class, 'toggle_color_status'])->name('toggle-status');
        Route::delete('/{id}/delete', [ColorController::class, 'delete_color'])->name('delete');
    });
    // Size Routes
    Route::prefix('sizes')->name('size.')->group(function () {
        Route::get('/', [SizeController::class, 'size_list'])->name('index');
        Route::post('/store', [SizeController::class, 'store_size'])->name('store');
        Route::get('/{id}/get', [SizeController::class, 'get_size'])->name('get');
        Route::post('/{id}/update', [SizeController::class, 'update_size'])->name('update');
        Route::post('/{id}/toggle-status', [SizeController::class, 'toggle_size_status'])->name('toggle-status');
        Route::delete('/{id}/delete', [SizeController::class, 'delete_size'])->name('delete');
    });

    // 🏷️ Category Routes
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'category_list'])->name('index');
        Route::get('/{id}/show', [CategoryController::class, 'show_category'])->name('show');
        Route::post('/store', [CategoryController::class, 'store_category'])->name('store');
        Route::get('/{id}/get', [CategoryController::class, 'get_category'])->name('get');
        Route::post('/{id}/update', [CategoryController::class, 'update_category'])->name('update');
        Route::delete('/{id}/delete', [CategoryController::class, 'delete_category'])->name('delete');
    });

    // 🏷️ Product Routes
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'product_list'])->name('index');
        Route::get('/add', [ProductController::class, 'add_product'])->name('add');
        Route::post('/store', [ProductController::class, 'store_product'])->name('store');
        Route::get('/{id}/show', [ProductController::class, 'show_product'])->name('show');
        Route::get('/{id}/get', [ProductController::class, 'get_product'])->name('get');
        Route::get('/{id}/edit', [ProductController::class, 'edit_product'])->name('edit');
        Route::put('/{id}/update', [ProductController::class, 'update_product'])->name('update');
        Route::delete('/{id}/delete', [ProductController::class, 'delete_product'])->name('delete');
        Route::delete('/image/{id}/delete', [ProductController::class, 'delete_product_image'])->name('image.delete');
        Route::post('/image/{id}/set-main', [ProductController::class, 'set_main_image'])->name('image.set-main');
    });



});
