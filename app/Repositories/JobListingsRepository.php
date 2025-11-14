<?php 

namespace App\Repositories;

use App\Models\AppliedJobs;
use App\Models\JobListings;
use Illuminate\Database\Eloquent\Collection;

class JobListingsRepository
{
    /**
     * @var JobListings
     */
    protected JobListings $model;

    /**
     * @param JobListings $model
     */
    public function __construct(JobListings $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new post
     *
     * @param array $data
     * @return JobListings
     */
    public function createPost(array $data): JobListings
    {
        return $this->model->create($data);
    }

    /**
     * Get list job
     * 
     * @param ?string $title
     * @return Collection
     */
    public function getListJob(?string $title = null): Collection
    {
        return $this->model
            ->select([
                'job_listings.id',
                'job_listings.title',
                'job_listings.is_publish',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'job_categories.name AS category',
                'job_listings.created_at',
                'job_listings.updated_at',
                'user_employer.name AS company_name',
            ])
            ->when($title, fn($query) => $query->where('job_listings.title', 'LIKE', '%' . $title . '%'))
            ->join('user_employer', 'job_listings.user_employer_id', '=', 'user_employer.id')
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->get();
    }

    /**
     * Get list job by employer id
     * 
     * @param string $userId
     * @param ?string $title
     * @return Collection
     */
    public function getListJobByEmployerId(string $userId, ?string $title = null): Collection
    {
        return $this->model
            ->select([
                'job_listings.id',
                'job_listings.title',
                'job_listings.is_publish',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'job_categories.name AS category',
                'job_listings.created_at',
                'job_listings.updated_at',
            ])
            ->addSelect([
                'total_applied_jobs' => AppliedJobs::selectRaw('COUNT(applied_jobs.id)')
                    ->whereColumn('applied_jobs.job_id', 'job_listings.id')
            ])
            ->where('job_listings.user_employer_id', $userId)
            ->when($title, fn($query) => $query->where('job_listings.title', 'LIKE', '%' . $title . '%'))
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->get();
    }

    /**
     * Get job detail with employer id and id
     * 
     * @param string $userId
     * @param string $jobId
     * @return JobListings
     */
    public function getJobDetailWithEmployerIdAndId(string $userId, string $jobId): JobListings
    {
        return $this->model
            ->select([
                'job_listings.id',
                'job_listings.title',
                'job_listings.description',
                'job_listings.qualifications',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'job_listings.minimum_salary',
                'job_listings.maximum_salary',
                'job_listings.is_publish',
                'job_listings.created_at',
                'job_listings.updated_at',
                'job_categories.name AS category',
            ])
            ->addSelect([
                'total_applied_jobs' => AppliedJobs::selectRaw('COUNT(applied_jobs.id)')
                    ->whereColumn('applied_jobs.job_id', 'job_listings.id')
            ])
            ->where('job_listings.user_employer_id', $userId)
            ->where('job_listings.id', $jobId)
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->first();
    }

    /**
     * Get job detail by id
     * 
     * @param string $jobId
     * @return JobListings
     */
    public function getJobDetailById(string $jobId): JobListings
    {
        return $this->model
            ->select([
                'job_listings.id',
                'job_listings.title',
                'job_listings.description',
                'job_listings.qualifications',
                'job_listings.employment_type',
                'job_listings.level_experience',
                'job_listings.location',
                'job_listings.minimum_salary',
                'job_listings.maximum_salary',
                'job_listings.is_publish',
                'job_listings.created_at',
                'job_listings.updated_at',
                'job_categories.name AS category',
                'user_employer.name AS company_name',
            ])
            ->addSelect([
                'total_applied_jobs' => AppliedJobs::selectRaw('COUNT(applied_jobs.id)')
                    ->whereColumn('applied_jobs.job_id', 'job_listings.id')
            ])
            ->where('job_listings.id', $jobId)
            ->join('user_employer', 'job_listings.user_employer_id', '=', 'user_employer.id')
            ->leftJoin('job_categories', 'job_listings.job_category_id', '=', 'job_categories.id')
            ->first();
    }
}