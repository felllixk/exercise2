<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\App\Modules\Frontend\Controllers')->group(function () {
    Route::middleware('web')->group(function () {
        Route::get('/', 'HomeController@create')->name('frontend-home');
    });
    Route::middleware(['api', 'auth:api'])->prefix('json')->group(function () {
        Route::any('store', 'JsonController@store')->name('frontend-json-store');
    });
});
