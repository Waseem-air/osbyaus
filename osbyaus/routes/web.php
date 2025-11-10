<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transaction', [AdminController::class, 'transaction'])->name('transaction');
Route::get('/store-menu', [AdminController::class, 'store_menu'])->name('store.menu');


Route::get('/addproduct', [ProductController::class, 'add_product'])->name('add.product');
 Route::get('/product-list', [ProductController::class, 'product_list'])->name('product_list');


 Route::get('/addcategory', [CategoryController::class, 'add_category'])->name('add.category');
 Route::get('/category-list', [CategoryController::class, 'category_list'])->name('category.list');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
