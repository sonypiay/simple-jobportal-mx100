<?php

namespace App\Services\Employer;

use App\Repositories\AppliedJobsRepository;

class AppliedJobService
{
    /**
     * @var AppliedJobsRepository
     */
    protected AppliedJobsRepository $appliedJobsRepository;

    /**
     * @param AppliedJobsRepository $appliedJobsRepository
     */
    public function __construct(AppliedJobsRepository $appliedJobsRepository)
    {
        $this->appliedJobsRepository = $appliedJobsRepository;
    }

    /**
     * Get list applied jobs
     * 
     * @param string $jobId
     * @param string $employerId
     * @return mixed
     */
    public function getListAppliedJobs(string $jobId, string $employerId): mixed
    {
        return $this->appliedJobsRepository->getListAppliedJobsByJobIdAndEmployerId($jobId, $employerId);
    }
}