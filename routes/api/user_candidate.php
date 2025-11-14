<?php 

/**
 * Name: User Employer Route
 * Path: /api/users/employer
 */

use App\Http\Controllers\Candidate\AppliedJobsController;
use Illuminate\Support\Facades\Route;

Route::prefix('candidate')->name('candidate.')->group(function() {
    Route::prefix('jobs')->name('jobs.')->group(function() {
        Route::get('/applied', [AppliedJobsController::class, 'getAppliedJobs'])->name('list');
    });
});