<?php

namespace App\Repositories;

use App\Models\UserCandidate;

class UserCandidateRepository
{
    /**
     * @var UserCandidate
     */
    protected UserCandidate $model;

    /**
     * @param UserCandidate $model
     */
    public function __construct(UserCandidate $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new user
     * 
     * @param array $data
     * @return UserCandidate
     */
    public function create(array $data): UserCandidate
    {
        return $this->model->create($data);
    }

    /**
     * Find user by email
     *
     * @param string $email
     * @return UserCandidate|null
     */
    public function findByEmail(string $email): ?UserCandidate
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Check if email exists
     * 
     * @param string $email
     * @param ?string $userId
     * @return bool
     */
    public function checkEmailExists(string $email, ?string $userId = null): bool
    {
        return $this->model
            ->select('email')
            ->where('email', $email)
            ->when($userId, fn($query) => $query->where('id', '!=', $userId))
            ->exists();
    }

    /**
     * Find user by user id
     * 
     * @param string $userId
     * @return UserCandidate|null
     */
    public function findByUserId(string $userId): ?UserCandidate
    {
        return $this->model->where('id', $userId)->first();
    }

    /**
     * Update profile
     * 
     * @param string $userId
     * @param array $data
     * @return void
     */
    public function updateProfile(string $userId, array $data): void
    {
        $this->model->where('id', $userId)->update($data);
    }

    /**
     * Change password
     * 
     * @param string $userId
     * @param string $password
     * 
     * @return void
     */
    public function changePassword(string $userId, string $password): void
    {
        $this->model->where('id', $userId)->update(['password' => $password]);
    }
}