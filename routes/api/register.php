<?php

/**
 * Name: Register User
 * Path: /api/register
 * Description: Register User
 */

use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('register')->name('register.')->group(function() {
    Route::post('/candidate', [RegisterUserController::class, 'registerAsCandidate'])->name('candidate');
    Route::post('/employer', [RegisterUserController::class, 'registerAsEmployer'])->name('employer');
});