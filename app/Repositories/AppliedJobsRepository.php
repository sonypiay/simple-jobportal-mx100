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
                'applied_jobs.created_at',
                'applied_jobs.updated_at',
                'job_listings.id AS job_id',
                'job_listings.title AS job_title',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'job_categories.name AS category',
                'user_employer.name AS company_name',
            ])
            ->join('job_listings', 'applied_jobs.job_id', '=', 'job_listings.id')
            ->join('user_employer', 'job_listings.user_employer_id', '=', 'user_employer.id')
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->where('applied_jobs.user_candidate_id', $userId)
            ->orderBy('applied_jobs.created_at', 'desc')
            ->get();
    }

    /**
     * Get list applied jobs by employer id
     * 
     * @param string $employerId
     * @return Collection
     */
    public function getListAppliedJobsByEmployerId(string $employerId): Collection
    {
        return $this->model
            ->select([
                'applied_jobs.id AS applied_job_id',
                'applied_jobs.status',
                'applied_jobs.created_at AS applied_date',
                'applied_jobs.updated_at AS last_updated',
                'job_listings.id AS job_id',
                'job_listings.title AS job_title',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'user_employer.name AS company_name',
                'user_candidate.id AS candidate_id',
                'user_candidate.name AS candidate_name',
                'user_candidate.email AS candidate_email',
                'user_candidate.phone AS candidate_phone',
                'job_categories.name AS category',
            ])
            ->join('job_listings', 'applied_jobs.job_id', '=', 'job_listings.id')
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->leftJoin('user_candidate', 'applied_jobs.user_candidate_id', '=', 'user_candidate.id')
            ->where('job_listings.user_employer_id', $employerId)
            ->orderBy('applied_jobs.created_at', 'desc')
            ->get();
    }

    /**
     * Get list applied jobs by job id and employer id
     * 
     * @param string $jobId
     * @param string $employerId
     * @return Collection
     */
    public function getListAppliedJobsByJobIdAndEmployerId(string $jobId, string $employerId): Collection
    {
        return $this->model
            ->select([
                'applied_jobs.id AS applied_job_id',
                'applied_jobs.status',
                'applied_jobs.created_at AS applied_date',
                'applied_jobs.updated_at AS last_updated',
                'applied_jobs.cover_letter',
                'applied_jobs.resume',
                'job_listings.id AS job_id',
                'job_listings.title AS job_title',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'user_employer.name AS company_name',
                'user_candidate.id AS candidate_id',
                'user_candidate.name AS candidate_name',
                'user_candidate.email AS candidate_email',
                'user_candidate.phone AS candidate_phone',
                'job_categories.name AS category',
            ])
            ->join('user_candidate', 'applied_jobs.user_candidate_id', '=', 'user_candidate.id')
            ->join('job_listings', 'applied_jobs.job_id', '=', 'job_listings.id')
            ->join('user_employer', 'job_listings.user_employer_id', '=', 'user_employer.id')
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->where([
                ['applied_jobs.job_id', $jobId],
                ['job_listings.user_employer_id', $employerId]
            ])
            ->orderBy('applied_jobs.created_at', 'desc')
            ->get();
    }

    /**
     * Check if candidate already applied
     * 
     * @param string $candidateId
     * @param string $jobId
     */
    public function existsByCandidateIdAndJobId(string $candidateId, string $jobId): bool
    {
        return $this->model->select('id')
            ->where([
                ['user_candidate_id', $candidateId],
                ['job_id', $jobId]
            ])
            ->exists();
    }
}