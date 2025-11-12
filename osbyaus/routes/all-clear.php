<?php
// clear route cache
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear'); // clears route, config, view, cache, events
    Artisan::call('config:cache');   // rebuild config cache
    Artisan::call('route:cache');    // rebuild route cache
    Artisan::call('view:cache');     // rebuild view cache
    return '✅ All caches cleared & re-cached successfully!';
});

#END Artisan
