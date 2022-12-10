<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('/', [\App\Modules\Frontend\Controllers\HomeController::class, 'index']);
});
