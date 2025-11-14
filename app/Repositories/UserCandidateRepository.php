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
     * @return bool
     */
    public function checkEmailExists(string $email): bool
    {
        return $this->model->select('email')->where('email', $email)->exists();
    }

    /**
     * Find user by user id
     * 
     * @param string $userId
     * @return UserCandidate|null
     */
    public function findByUserId(string $userId): ?UserCandidate
    {
        return $this->model->where('user_id', $userId)->first();
    }
}