<?php

namespace App\Http\Controllers;

use App\Constants\HttpStatus;
use App\Services\JobsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * @var JobsService
     */
    protected JobsService $jobsService;

    /**
     * @param JobsService $jobsService
     */
    public function __construct(JobsService $jobsService)
    {
        $this->jobsService = $jobsService;
    }

    public function getListJob(Request $request): JsonResponse
    {
        $result = $this->jobsService->getListJob($request);

        return response()->json($result);
    }

    public function getJobDetail($jobId): JsonResponse
    {
        $result = $this->jobsService->getJobDetail($jobId);

        return response()->json($result);
    }

    public function applyJob(Request $request, $jobId): JsonResponse
    {
        $userId = Auth::user()->user_id;
        $result = $this->jobsService->applyJob($userId, $jobId, $request);
        $response = [
            'message' => 'Apply job success!',
            'data' => $result
        ];
        return response()->json($response, HttpStatus::HTTP_CREATED);
    }
}