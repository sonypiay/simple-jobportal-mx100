<?php

namespace App\Repositories;

use App\Constants\AppliedJobStatus;
use App\Models\AppliedJobs;
use Illuminate\Database\Eloquent\Collection;

class AppliedJobsRepository
{
    /**
     * @var AppliedJobs
     */
    protected AppliedJobs $model;

    /**
     * @param AppliedJobs $model
     */
    public function __construct(AppliedJobs $model)
    {
        $this->model = $model;
    }

    /**
     * Apply job
     * 
     * @param string $jobId
     * @param string $userId
     * @param string $coverLetter
     * @param string $resume
     * @return AppliedJobs
     */
    public function apply(string $jobId, string $userId, string $coverLetter, string $resume): AppliedJobs
    {
        return $this->model->create([
            'job_id' => $jobId,
            'user_candidate_id' => $userId,
            'cover_letter' => $coverLetter,
            'resume' => $resume,
            'status' => AppliedJobStatus::PENDING,
        ]);
    }

    /**
     * Get applied jobs
     *
     * @param string $userId
     * @return Collection
     */
    public function getAppliedJobsByCandidateUser(string $userId): Collection
    {
        return $this->model
            ->select([
                'applied_jobs.id AS applied_job_id',
                'applied_jobs.status',
                'job_listings.id AS job_id',
                'job_listings.title AS job_title',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'job_categories.name AS category',
                'user_employer.name AS company_name',
            ])
            ->where('applied_jobs.user_candidate_id', $userId)
            ->join('job_listings', 'applied_jobs.job_id', '=', 'job_listings.id')
            ->join('user_employer', 'job_listings.user_employer_id', '=', 'user_employer.id')
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->orderBy('applied_jobs.created_at', 'desc')
            ->get();
    }
}