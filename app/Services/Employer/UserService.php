<?php

namespace App\Services\Employer;

use App\Exceptions\ConflictException;
use App\Http\Resources\User\Employer\UserDetailResource;
use App\Repositories\UserEmployerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var UserEmployerRepository
     */
    protected UserEmployerRepository $userEmployerRepository;

    /**
     * @param UserEmployerRepository $userEmployerRepository
     */
    public function __construct(UserEmployerRepository $userEmployerRepository)
    {
        $this->userEmployerRepository = $userEmployerRepository;
    }

    /**
     * Get profile
     * 
     * @return UserDetailResource
     */
    public function getProfile(): UserDetailResource
    {
        return new UserDetailResource(
            $this->userEmployerRepository->findByUserId(Auth::user()->user_id)
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
            $description = $request->input('description');
            $industry = $request->input('industry');
            $company_size = $request->input('company_size');
            $website = $request->input('website');
            $specialization = $request->input('specialization');

            $checkIfEmailExists = $this->userEmployerRepository->checkEmailExists($email, $userId);
            if( $checkIfEmailExists ) throw new ConflictException("Email {$email} sudah terdaftar");

            return $this->userEmployerRepository->updateProfile($userId, [
                'name' => $fullname,
                'email' => $email,
                'address' => $address,
                'description' => $description,
                'industry' => $industry,
                'company_size' => $company_size,
                'website' => $website,
                'specialization' => $specialization,
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
            $this->userEmployerRepository->changePassword($userId, Hash::make($newPassword));
        });
    }
}