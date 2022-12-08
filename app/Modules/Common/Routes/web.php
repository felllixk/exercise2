<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Modules\Common\Controllers\UserController::class, 'index']);
