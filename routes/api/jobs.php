<?php

/**
 * Name: Jobs Route
 * Path: /api/jobs
 */

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'auth.check-role:candidate'])->group(function() {
    Route::prefix('jobs')->name('jobs.')->group(function() {
        Route::get('/', [JobController::class, 'getListJob'])->name('list');
        Route::post('{id}/apply', [JobController::class, 'applyJob'])->name('apply');
        Route::get('{id}', [JobController::class, 'getJobDetail'])->name('detail');
    });
});