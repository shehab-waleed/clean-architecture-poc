<?php

use Illuminate\Support\Facades\Route;
use Src\api\Controllers\UserController;

Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
});
