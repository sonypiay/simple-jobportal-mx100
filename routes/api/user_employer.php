<?php 

/**
 * Name: User Employer Route
 * Path: /api/users/employer
 */

use App\Http\Controllers\Employer\JobController;
use Illuminate\Support\Facades\Route;

Route::prefix('employer')->name('employer.')->group(function() {
    Route::prefix('jobs')->name('jobs.')->group(function() {
        Route::get('/', [JobController::class, 'getListJob'])->name('list');
        Route::post('create', [JobController::class, 'create'])->name('create');
        Route::get('{id}', [JobController::class, 'getJobDetail'])->name('detail');
    });
});