<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ---------------------------------------------------------
// 🧭 All Cache Clear
// ---------------------------------------------------------
require __DIR__ . '/all-clear.php';

// ---------------------------------------------------------
// 🧭 Website Routes
// ---------------------------------------------------------
require __DIR__ . '/website.php';

// ---------------------------------------------------------
// 🧭 Cart Routes
// ---------------------------------------------------------
require __DIR__ . '/cart_routes.php';

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ---------------------------------------------------------
// 🧭 Auth Routes
// ---------------------------------------------------------
require __DIR__.'/auth.php';


// ---------------------------------------------------------
// 🧭 Admin Panel Routes
// ---------------------------------------------------------
require __DIR__ . '/admin_routes.php';
