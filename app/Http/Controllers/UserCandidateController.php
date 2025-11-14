<?php

namespace App\Http\Controllers;

use App\Constants\HttpStatus;
use App\Http\Requests\User\Candidate\RegisterRequest;
use App\Services\UserCandidateService;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserCandidateController extends Controller
{
    /**
     * @var UserCandidateService
     */
    protected UserCandidateService $userCandidateService;

    /**
     * @param UserCandidateService $userCandidateService
     */
    public function __construct(UserCandidateService $userCandidateService)
    {
        $this->userCandidateService = $userCandidateService;
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->userCandidateService->register($request);
        return response()->json(['message' => 'User candidate registered successfully.'], HttpStatus::HTTP_CREATED);
    }
}
