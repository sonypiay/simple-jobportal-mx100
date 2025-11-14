<?php

namespace App\Services\Candidate;

use App\Exceptions\ConflictException;
use App\Http\Resources\User\Candidate\UserDetailResource;
use App\Repositories\UserCandidateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
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
     * Get profile
     * 
     * @return UserDetailResource
     */
    public function getProfile(): UserDetailResource
    {
        return new UserDetailResource(
            $this->userCandidateRepository->findByUserId(Auth::user()->user_id)
        );
    }

    /**
     * Update profile
     * 
     * @param \Illuminate\Http\Request $request
     * @return UserDetailResource
     */
    public function updateProfile(Request $request)
    {
        return DB::transaction(function() use ($request) {
            $userId = Auth::user()->user_id;
            $email = $request->input('email');
            $fullname = $request->input('fullname');
            $address = $request->input('address');
            $phone = $request->input('phone');
            $description = $request->input('description');

            $checkIfEmailExists = $this->userCandidateRepository->checkEmailExists($email, $userId);
            if( $checkIfEmailExists ) throw new ConflictException("Email {$email} sudah terdaftar");

            return $this->userCandidateRepository->updateProfile($userId, [
                'name' => $fullname,
                'email' => $email,
                'address' => $address,
                'description' => $description,
                'phone' => $phone,
            ]);
        });
    }

    /**
     * Change password
     * 
     * @param string $newPassword
     * 
     * @return void
     */
    public function changePassword(string $newPassword): void
    {
        DB::transaction(function() use ($newPassword) {
            $userId = Auth::user()->user_id;
            $this->userCandidateRepository->changePassword($userId, Hash::make($newPassword));
        });
    }
}