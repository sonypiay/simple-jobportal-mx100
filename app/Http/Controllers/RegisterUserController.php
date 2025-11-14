<?php

namespace App\Http\Controllers;

use App\Constants\HttpStatus;
use App\Http\Requests\User\Candidate\RegisterRequest as CandidateRegisterRequest;
use App\Http\Requests\User\Employer\RegisterRequest as EmployerRegisterRequest;
use App\Services\RegisterUserService;
use Illuminate\Http\JsonResponse;

class RegisterUserController extends Controller
{
    /**
     * @var UserCandidateService
     */
    protected RegisterUserService $registerUserService;

    /**
     * @param RegisterUserService $registerUserService
     */
    public function __construct(RegisterUserService $registerUserService)
    {
        $this->registerUserService = $registerUserService;
    }

    /**
     * @param CandidateRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerAsCandidate(CandidateRegisterRequest $request): JsonResponse
    {
        $this->registerUserService->registerAsCandidate($request);
        return response()->json(['message' => 'User candidate registered successfully.'], HttpStatus::HTTP_CREATED);
    }

    /**
     * @param EmployerRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerAsEmployer(EmployerRegisterRequest $request): JsonResponse
    {
        $this->registerUserService->registerAsEmployer($request);
        return response()->json(['message' => 'User employer registered successfully.'], HttpStatus::HTTP_CREATED);
    }
}
