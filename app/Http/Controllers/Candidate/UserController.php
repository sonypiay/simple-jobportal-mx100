<?php

namespace App\Http\Controllers\Candidate;

use App\Constants\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Candidate\ChangePasswordRequest;
use App\Http\Requests\User\Candidate\UpdateProfileRequest;
use App\Services\Candidate\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(Request $request): JsonResponse
    {
        $users = $this->userService->getProfile($request);
        return response()->json($users);
    }

    /**
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $this->userService->updateProfile($request);

        return response()->json([
            'message' => 'Profile updated successfully'
        ], HttpStatus::HTTP_ACCEPTED);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->userService->changePassword($request->password);
        return response()->json(['message' => 'Password changed successfully' ], HttpStatus::HTTP_ACCEPTED);
    }
}
