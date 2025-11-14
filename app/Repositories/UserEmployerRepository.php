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
     * @return UserEmployer|null
     */
    public function findByUserId(string $userId): ?UserEmployer
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