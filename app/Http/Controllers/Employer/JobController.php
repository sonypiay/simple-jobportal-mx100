<?php

namespace App\Http\Controllers\Employer;

use App\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use App\Services\Employer\JobsService;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $result = $this->jobsService->create($request);

        $response = [
            'message' => 'Job successfully posted',
            'data' => $result
        ];

        return response()->json($response, HttpStatus::HTTP_CREATED);
    }

    public function getListJob(Request $request): JsonResponse
    {
        $userId = Auth::user()->user_id;
        $result = $this->jobsService->getListJob($userId, $request);

        return response()->json($result);
    }

    public function getJobDetail($jobId): JsonResponse
    {
        $userId = Auth::user()->user_id;
        $result = $this->jobsService->getJobDetail($userId, $jobId);

        return response()->json($result);
    }
}
