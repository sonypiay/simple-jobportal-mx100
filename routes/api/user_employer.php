<?php 

/**
 * Name: User Employer Route
 * Path: /api/users/employer
 */

use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('employer')->name('employer.')->group(function() {
    Route::prefix('profile')->name('profile.')->group(function() {
        Route::get('/', [UserController::class, 'getProfile'])->name('get-profile');
        Route::put('update', [UserController::class, 'updateProfile'])->name('update-profile');
        Route::patch('change-password', [UserController::class, 'changePassword'])->name('change-password');
    });

    Route::prefix('jobs')->name('jobs.')->group(function() {
        Route::get('/', [JobController::class, 'getListJob'])->name('list');
        Route::post('create', [JobController::class, 'create'])->name('create');
        Route::put('{id}/update', [JobController::class, 'updateJob'])->name('update');
        Route::patch('{id}/update-status', [JobController::class, 'updateStatusJob'])->name('update-status');
        Route::get('{id}', [JobController::class, 'getJobDetail'])->name('detail');
    });
});