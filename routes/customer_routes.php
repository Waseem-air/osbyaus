<?php

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;


Route::prefix('customer')->name('customer.')->middleware(['role:customer'])->group(function () {
    // 🧾 Customer Dashboard Routes
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');

});
