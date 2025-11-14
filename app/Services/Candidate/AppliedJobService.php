<?php

namespace App\Services\Candidate;

use App\Http\Resources\User\Jobs\AppliedJobsListResource;
use App\Repositories\AppliedJobsRepository;
use Illuminate\Support\Facades\Auth;

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
     * @param string $userId
     * @return array
     */
    public function getAppliedJobs(string $userId): array
    {
        $result = $this->appliedJobsRepository->getAppliedJobsByCandidateUser($userId);

        return [
            'total' => $result->count(),
            'data' => AppliedJobsListResource::collection($result),
        ];
    }
}