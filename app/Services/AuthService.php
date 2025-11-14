<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Repositories\UserCandidateRepository;
use App\Repositories\UserEmployerRepository;
use App\Repositories\UserSessionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
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
     * @var UserSessionRepository
     */
    protected UserSessionRepository $userSessionRepository;

    /**
     * @param UserCandidateRepository $userCandidateRepository
     * @param UserEmployerRepository $userEmployerRepository
     * @param UserSessionRepository $userSessionRepository
     */
    public function __construct(
        UserCandidateRepository $userCandidateRepository,
        UserEmployerRepository $userEmployerRepository,
        UserSessionRepository $userSessionRepository
    )
    {
        $this->userCandidateRepository = $userCandidateRepository;
        $this->userEmployerRepository = $userEmployerRepository;
        $this->userSessionRepository = $userSessionRepository;
    }

    /**
     * User authentication
     * 
     * @param string $userType
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function authenticate(string $userType, Request $request): array
    {
        // cek berdasarkan tipe user (candidate|employer)
        $user = $userType === 'candidate' 
        ? $this->userCandidateRepository->findByEmail($request->email)
        : $this->userEmployerRepository->findByEmail($request->email);

        // cek apabila user tidak ditemukan
        if (!$user) {
            throw new NotFoundException("User not found");
        }

        // verifikasi password
        if (! Hash::check($request->password, $user->password)) {
            throw new UnauthorizedException("Invalid email or password");
        }

        $session = $this->userSessionRepository->store([
            'user_id' => $user->id,
            'user_type' => $userType,
        ]);

        return [
            'user_id' => $user->id,
            'user_type' => $userType,
            'token' => $session->api_token
        ];
    }

    /**
     * User logout
     * 
     * @param string $token
     *
     * @return void
     */
    public function logout(string $token): void
    {
        if( ! $this->userSessionRepository->existsByToken($token) )
            throw new UnauthorizedException("Unauthenticated");

        $this->userSessionRepository->deleteByToken($token);
    }
}