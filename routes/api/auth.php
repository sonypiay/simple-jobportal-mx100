<?php

/**
 * Name: Authentication API
 * Path: /api/auth
 */

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function() {
    Route::post('login/{userType}', [AuthenticationController::class, 'login'])->name('login');
    Route::delete('logout', [AuthenticationController::class, 'logout'])->name('logout');
});