<?php

namespace App\Http\Controllers;

use App\Constants\HttpStatus;
use App\Http\Requests\User\Employer\RegisterRequest;
use App\Services\UserEmployerService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserEmployerController extends Controller
{
    /**
     * @var UserEmployerService
     */
    protected UserEmployerService $userEmployerService;

    /**
     * @param UserEmployerService $userEmployerService;
     */
    public function __construct(UserEmployerService $userEmployerService)
    {
        $this->userEmployerService = $userEmployerService;
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->userEmployerService->register($request);
        return response()->json(['message' => 'User employer registered successfully.'], HttpStatus::HTTP_CREATED);
    }
}
