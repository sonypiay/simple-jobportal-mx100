<?php

/**
 * Name: Register User
 * Path: /api/register
 * Description: Register User
 */

use App\Http\Controllers\UserCandidateController;
use App\Http\Controllers\UserEmployerController;
use Illuminate\Support\Facades\Route;

Route::prefix('register')->name('register.')->group(function() {
    Route::post('/candidate', [UserCandidateController::class, 'register'])->name('candidate');
    Route::post('/employer', [UserEmployerController::class, 'register'])->name('employer');
});