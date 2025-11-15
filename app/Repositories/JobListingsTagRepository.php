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

    /**
     * Get list tags by job id
     * 
     * @param string $jobId
     * @return array
     */
    public function getTagsByJobId(string $jobId): array
    {
        return $this->model
            ->select('name')
            ->where('job_listing_id', $jobId)
            ->pluck('name')
            ->toArray();
    }

    /**
     * Delete tag by job id
     * 
     * @param string $jobId
     * @return void
     */
    public function deleteByJobId(string $jobId): void
    {
        $this->model->where('job_listing_id', $jobId)->delete();
    }
}