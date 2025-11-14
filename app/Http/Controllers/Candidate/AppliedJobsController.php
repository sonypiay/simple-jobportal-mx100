<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Services\Candidate\AppliedJobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AppliedJobsController extends Controller
{
    /**
     * @var AppliedJobService
     */
    protected AppliedJobService $appliedJobService;

    /**
     * @param JobsService $jobsService
     */
    public function __construct(AppliedJobService $appliedJobService)
    {
        $this->appliedJobService = $appliedJobService;
    }

    public function getAppliedJobs(): JsonResponse
    {
        $result = $this->appliedJobService->getAppliedJobs(Auth::user()->user_id);
        return response()->json($result);
    }
}
