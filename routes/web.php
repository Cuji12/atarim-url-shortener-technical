<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::controller(UrlController::class)->group(function() {
   Route::get('/', 'index')->name('url.index');
   Route::get('/{short_url}', 'redirectOriginal')->name('url.redirectOriginal');
   Route::post('/shorten', 'storeUrl')->name('url.storeUrl');
});
