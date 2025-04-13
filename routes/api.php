<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::controller(UrlController::class)->group(function () {
    Route::post('/encode_url', 'encodeUrl')->name('api.url.encodeUrl');
    Route::get('/decode_url/{short_url}', 'decodeUrl')->name('api.url.decodeUrl');
})->middleware(['auth:sanctum']);

