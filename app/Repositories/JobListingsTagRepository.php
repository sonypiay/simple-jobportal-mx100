<?php

namespace App\Repositories;

use App\Models\JobListingsTag;
use Illuminate\Database\Eloquent\Collection;

class JobListingsTagRepository
{
    /**
     * @var JobListingsTag
     */
    protected JobListingsTag $model;

    /**
     * @param JobListingsTag $model
     */
    public function __construct(JobListingsTag $model)
    {
        $this->model = $model;
    }

    /**
     * Bulk insert new tag
     * 
     * @param array $data
     * @return Collection
     */
    public function bulkInsert(array $data): void
    {
        $this->model->insert($data);
    }
}