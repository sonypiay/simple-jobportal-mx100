<?php

namespace App\Http\Controllers\Employer;

use App\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Employer\PostJobRequest;
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
     * @param PostJobRequest $request
     * @return JsonResponse
     */
    public function create(PostJobRequest $request): JsonResponse
    {
        $result = $this->jobsService->create($request);

        $response = [
            'message' => 'Job successfully posted',
            'data' => $result
        ];

        return response()->json($response, HttpStatus::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getListJob(Request $request): JsonResponse
    {
        $userId = Auth::user()->user_id;
        $result = $this->jobsService->getListJob($userId, $request);

        return response()->json($result);
    }

    /**
     * @param $jobId
     * @return JsonResponse
     */
    public function getJobDetail($jobId): JsonResponse
    {
        $userId = Auth::user()->user_id;
        $result = $this->jobsService->getJobDetail($userId, $jobId);

        return response()->json($result);
    }

    /**
     * @param PostJobRequest $request
     * @param $jobId
     * @return JsonResponse
     */
    public function updateJob(PostJobRequest $request, $jobId): JsonResponse
    {
        $this->jobsService->updateJob($request, $jobId);
        return response()->json(['message' => 'Job successfully updated'], HttpStatus::HTTP_ACCEPTED);
    }

    /**
     * @param Request $request
     * @param $jobId
     * @return JsonResponse
     */
    public function updateStatusJob(Request $request, $jobId): JsonResponse
    {
        $this->jobsService->updateStatusJob($jobId, $request->input('status'));
        return response()->json(['message' => 'Job status successfully updated'], HttpStatus::HTTP_ACCEPTED);
    }
}
