<?php 

/**
 * Name: User Route
 * Path: /api/users
 */

use Illuminate\Support\Facades\Route;

Route::prefix('users')->name('users.')->group(function() {
    Route::middleware('auth:api')->group(function() {
        // employer
        require_once __DIR__ . '/user_employer.php';

        // candidate
        require_once __DIR__ . '/user_candidate.php';
    });
});