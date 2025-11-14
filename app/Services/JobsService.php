<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\Resources\Jobs\JobDetailResource;
use App\Http\Resources\Jobs\JobListResource;
use App\Repositories\AppliedJobsRepository;
use App\Repositories\JobListingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobsService
{
    /**
     * @var JobListingsRepository
     */
    protected JobListingsRepository $jobListingsRepository;

    /**
     * @var AppliedJobsRepository
     */
    protected AppliedJobsRepository $appliedJobsRepository;
    
    /**
     * @param JobListingsRepository $jobListingsRepository
     * @param AppliedJobsRepository $appliedJobsRepository
     */
    public function __construct(
        JobListingsRepository $jobListingsRepository,
        AppliedJobsRepository $appliedJobsRepository
    )
    {
        $this->jobListingsRepository = $jobListingsRepository;
        $this->appliedJobsRepository = $appliedJobsRepository;
    }

    /**
     * Get list jobs
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getListJob(Request $request): array
    {
        $result = $this->jobListingsRepository->getListJob($request->title);

        return [
            'total' => $result->count(),
            'data' => JobListResource::collection($result),
        ];
    }

    /**
     * Get job detail
     * 
     * @param string $jobId
     * @return JobDetailResource
     */
    public function getJobDetail(string $jobId): JobDetailResource
    {
        $result = $this->jobListingsRepository->getJobDetailById($jobId);

        if( ! $result ) throw new NotFoundException("Job not found");

        return new JobDetailResource($result);
    }

    /**
     * Apply job
     * 
     * @param string $userId
     * @param string $jobId
     * @param \Illuminate\Http\Request $request
     * 
     * @return array
     */
    public function applyJob(string $userId, string $jobId, Request $request): array
    {
        if( $this->jobListingsRepository->existsById($jobId) === false ) {
            throw new NotFoundException("Job not found");
        }

        if( $this->appliedJobsRepository->existsByCandidateIdAndJobId($userId, $jobId) ) {
            throw new BadRequestException("You have already applied for this job");
        }

        $coverLetter = $request->file('cover_letter');
        $resume = $request->file('resume');

        if( ! $coverLetter ) throw new BadRequestException("Cover letter is required"); 
        if( ! $resume ) throw new BadRequestException("Resume is required");

        $coverLetterName = $coverLetter->hashName();
        $resumeName = $resume->hashName();

        // upload file to storage
        $coverLetter->storeAs('apply_job/cover_letter', $coverLetterName);
        $resume->storeAs('apply_job/resume', $resumeName);

        $result = $this->appliedJobsRepository->apply($jobId, $userId, $coverLetterName, $resumeName);

        return [
            'apply_id' => $result->id,
            'job_id' => $result->job_id,
        ];
    }
}