<?php

namespace App\Services;

use App\Constants\IsActive;
use App\Exceptions\ConflictException;
use App\Models\UserEmployer;
use App\Repositories\UserEmployerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserEmployerService
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
     * User registration
     * 
     * @param Illuminate\Http\Request $request
     * @return UserCandidate
     */
    public function register(Request $request): UserEmployer
    {
        return DB::transaction(function() use ($request) {
            $email = $request->input('email');
            $fullname = $request->input('fullname');
            $password = $request->input('password');
            $address = $request->input('address');
            $description = $request->input('description');
            $industry = $request->input('industry');
            $company_size = $request->input('company_size');
            $website = $request->input('website');
            $specialization = $request->input('specialization');

            $checkIfEmailExists = $this->userEmployerRepository->checkEmailExists($email);
            if( $checkIfEmailExists ) throw new ConflictException("Email {$email} sudah terdaftar");

            return $this->userEmployerRepository->create([
                'name' => $fullname,
                'email' => $email,
                'password' => Hash::make($password),
                'address' => $address,
                'description' => $description,
                'industry' => $industry,
                'company_size' => $company_size,
                'website' => $website,
                'specialization' => $specialization,
                'is_active' => IsActive::ACTIVE,
            ]);
        });
    }
}