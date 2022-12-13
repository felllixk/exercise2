<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\App\Modules\Backend\Controllers')->group(function () {
    Route::middleware('web')->prefix('admin')->group(function () {
        Route::get('/', 'AdminController@create');
        Route::prefix('json')->group(function () {
            Route::get('/', 'JsonController@index')->name('backend-json-index');
            Route::delete('/{id}', 'JsonController@delete')->name('backend-json-delete');
            Route::put('/{id}', 'JsonController@update')->name('backend-json-update');
        });
    });
});
