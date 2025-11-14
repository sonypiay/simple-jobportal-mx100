<?php

namespace App\Repositories;

use App\Models\UserEmployer;

class UserEmployerRepository
{
    /**
     * @var UserEmployer
     */
    protected UserEmployer $model;

    /**
     * @param UserEmployer $model
     */
    public function __construct(UserEmployer $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new user
     * 
     * @param array $data
     * @return UserEmployer
     */
    public function create(array $data): UserEmployer
    {
        return $this->model->create($data);
    }

    /**
     * Find user by email
     * 
     * @param string $email
     * @return UserEmployer|null
     */
    public function findByEmail(string $email): ?UserEmployer
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
     * @return UserEmployer|null
     */
    public function findByUserId(string $userId): ?UserEmployer
    {
        return $this->model->where('user_id', $userId)->first();
    }
}