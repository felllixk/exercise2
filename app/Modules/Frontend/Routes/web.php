<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Modules\Frontend\Controllers\HomeController::class, 'index']);
