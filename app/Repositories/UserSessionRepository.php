<?php

namespace App\Repositories;

use App\Models\UserSession;

class UserSessionRepository
{
    /**
     * @var UserSession
     */
    protected UserSession $model;

    /**
     * @param UserSession $model
     */
    public function __construct(UserSession $model)
    {
        $this->model = $model;
    }

    /**
     * Store new session
     * 
     * @param array $data
     * @return UserSession
     */
    public function store(array $data): UserSession
    {
        return $this->model->create($data);
    }

    /**
     * Delete session by token
     * 
     * @param string $token
     * @return void
     */
    public function deleteByToken(string $token): void
    {
        $this->model->where('api_token', $token)->delete();
    }

    /**
     * Check session by token
     * 
     * @param string $token
     * @return bool
     */
    public function existsByToken(string $token): bool
    {
        return $this->model
            ->select('api_token')
            ->where('api_token', $token)
            ->exists();
    }

    /**
     * Get session by token
     *
     * @param string $token
     * @return UserSession|null
     */
    public function getByToken(string $token): ?UserSession
    {
        return $this->model->where('api_token', $token)->first();
    }

    /**
     * Get session by id
     * 
     * @param string $id
     * @return UserSession|null
     */
    public function getById(string $id): ?UserSession
    {
        return $this->model->find($id);
    }
}