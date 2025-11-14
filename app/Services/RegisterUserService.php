<?php

namespace App\Services;

use App\Constants\IsActive;
use App\Exceptions\ConflictException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserCandidate;
use App\Models\UserEmployer;
use App\Repositories\UserCandidateRepository;
use App\Repositories\UserEmployerRepository;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
    /**
     * @var UserCandidateRepository
     */
    protected UserCandidateRepository $userCandidateRepository;

    /**
     * @var UserEmployerRepository
     */
    protected UserEmployerRepository $userEmployerRepository;

    /**
     * @param UserCandidateRepository $userCandidateRepository
     * @param UserEmployerRepository $userEmployerRepository
     */
    public function __construct(
        UserCandidateRepository $userCandidateRepository,
        UserEmployerRepository $userEmployerRepository
    )
    {
        $this->userCandidateRepository = $userCandidateRepository;
        $this->userEmployerRepository = $userEmployerRepository;
    }

    /**
     * User registration as candidate
     * 
     * @param Illuminate\Http\Request $request
     * @return array
     */
    public function registerAsCandidate(Request $request): array
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

    /**
     * User registration
     * 
     * @param Illuminate\Http\Request $request
     * @return UserCandidate
     */
    public function registerAsEmployer(Request $request): UserEmployer
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