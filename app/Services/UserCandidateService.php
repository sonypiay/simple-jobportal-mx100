<?php

namespace App\Services;

use App\Constants\IsActive;
use App\Exceptions\ConflictException;
use App\Http\Resources\User\Candidate\UserDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserCandidate;
use App\Repositories\UserCandidateRepository;
use Illuminate\Support\Facades\Hash;

class UserCandidateService
{
    /**
     * @var UserCandidateRepository
     */
    protected UserCandidateRepository $userCandidateRepository;

    /**
     * @param UserCandidateRepository $userCandidateRepository
     */
    public function __construct(UserCandidateRepository $userCandidateRepository)
    {
        $this->userCandidateRepository = $userCandidateRepository;
    }

    /**
     * User registration
     * 
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function register(Request $request): array
    {
        return DB::transaction(function() use ($request) {
            $email = $request->input('email');
            $fullname = $request->input('fullname');
            $password = $request->input('password');

            $checkIfEmailExists = $this->userCandidateRepository->checkEmailExists($email);
            if( $checkIfEmailExists ) throw new ConflictException("Email {$email} sudah terdaftar");

            $user = $this->userCandidateRepository->create([
                'name' => $fullname,
                'email' => $email,
                'password' => Hash::make($password),
                'is_active' => IsActive::ACTIVE,
            ]);

            return [
                'name' => $user->name,
                'email' => $user->email,
            ];
        });
    }
}