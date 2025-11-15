<?php 

/**
 * Name: User Candidate Route
 * Path: /api/users/candidate
 */

use App\Http\Controllers\Candidate\AppliedJobsController;
use App\Http\Controllers\Candidate\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.check-role:candidate')->group(function() {
    Route::prefix('candidate')->name('candidate.')->group(function() {
        Route::prefix('profile')->name('profile.')->group(function() {
            Route::get('/', [UserController::class, 'getProfile'])->name('get-profile');
            Route::put('update', [UserController::class, 'updateProfile'])->name('update-profile');
            Route::patch('change-password', [UserController::class, 'changePassword'])->name('change-password');
        });

        Route::prefix('jobs')->name('jobs.')->group(function() {
            Route::get('/applied', [AppliedJobsController::class, 'getAppliedJobs'])->name('list');
        });
    });
});