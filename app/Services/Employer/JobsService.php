<?php

namespace App\Services\Employer;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\Resources\User\Employer\Jobs\JobDetailResource;
use App\Http\Resources\User\Employer\Jobs\JobListResource;
use App\Repositories\AppliedJobsRepository;
use App\Repositories\JobListingsRepository;
use App\Repositories\JobListingsTagRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobsService
{
    /**
     * @var JobListingsRepository
     */
    protected JobListingsRepository $jobListingsRepository;

    /**
     * @var JobListingsTagRepository
     */
    protected JobListingsTagRepository $jobListingsTagRepository;

    /**
     * @var AppliedJobsRepository
     */
    protected AppliedJobsRepository $appliedJobsRepository;

    /**
     * @param JobListingsRepository $jobListingsRepository
     * @param JobListingsTagRepository $jobListingsTagRepository
     * @param AppliedJobsRepository $appliedJobsRepository
     */
    public function __construct(
        JobListingsRepository $jobListingsRepository,
        JobListingsTagRepository $jobListingsTagRepository,
        AppliedJobsRepository $appliedJobsRepository
    )
    {
        $this->jobListingsRepository = $jobListingsRepository;
        $this->jobListingsTagRepository = $jobListingsTagRepository;
        $this->appliedJobsRepository = $appliedJobsRepository;
    }

    /**
     * Create new post
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function create(Request $request): array
    {
        $userId = Auth::user()->user_id;

        return DB::transaction(function () use ($request, $userId) {
            $dataJob = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'qualifications' => $request->input('qualification'),
                'location' => $request->input('location'),
                'employment_type' => $request->input('employment_type'),
                'level_experience' => $request->input('level_experience'),
                'minimum_salary' => $request->input('minimum_salary'),
                'maximum_salary' => $request->input('maximum_salary'),
                'user_employer_id' => $userId,
                'job_category_id' => $request->input('category'),
            ];

            $job = $this->jobListingsRepository->createPost($dataJob);

            $tags = $request->input('tags');
            $dataTags = [];
            $sortTag = 1;

            foreach( $tags as $tag ) {
                $dataTags[] = [
                    'id' => Str::orderedUuid(),
                    'job_listing_id' => $job->id,
                    'name' => $tag,
                    'sort' => $sortTag,
                ];

                $sortTag++;
            }

            if( ! empty( $dataTags ) ) {
                $this->jobListingsTagRepository->bulkInsert($dataTags);
            }

            return [
                'id' => $job->id,
                'title' => $job->title,
                'tags' => $tags
            ];
        });
    }

    /**
     * Update job
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $jobId
     * @return array
     */
    public function updateJob(Request $request, string $jobId): void
    {
        if( ! $this->jobListingsRepository->existsById($jobId) ) throw new NotFoundException('Job not found');

        DB::transaction(function () use ($request, $jobId) {
            $userId = Auth::user()->user_id;

            $dataJob = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'qualifications' => $request->input('qualification'),
                'location' => $request->input('location'),
                'employment_type' => $request->input('employment_type'),
                'level_experience' => $request->input('level_experience'),
                'minimum_salary' => $request->input('minimum_salary'),
                'maximum_salary' => $request->input('maximum_salary'),
                'user_employer_id' => $userId,
                'job_category_id' => $request->input('category'),
            ];

            $this->jobListingsRepository->updatePost($jobId, $dataJob);

            $tags = $request->input('tags');
            $dataTags = [];
            $sortTag = 1;

            foreach( $tags as $tag ) {
                $dataTags[] = [
                    'id' => Str::orderedUuid(),
                    'job_listing_id' => $jobId,
                    'name' => $tag,
                    'sort' => $sortTag,
                ];

                $sortTag++;
            }

            if( ! empty( $dataTags ) ) {
                $this->jobListingsTagRepository->deleteByJobId($jobId);
                $this->jobListingsTagRepository->bulkInsert($dataTags);
            }
        });
    }

    /**
     * Get list jobs
     * 
     * @param string $userId
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getListJob(string $userId, Request $request): array
    {
        $result = $this->jobListingsRepository->getListJobByEmployerId($userId, $request->input('title'));

        return [
            'data' => JobListResource::collection($result),
            'total' => $result->count(),
        ];
    }

    /**
     * Get job detail
     * 
     * @param string $userId
     * @param string $jobId
     * @return JsonResource
     */
    public function getJobDetail(string $userId, string $jobId): JsonResource
    {
        $result = $this->jobListingsRepository->getJobDetailWithEmployerIdAndId($userId, $jobId);

        if( ! $result ) throw new NotFoundException("Job not found");

        $result->list_candidates = $this->appliedJobsRepository->getListAppliedJobsByJobIdAndEmployerId($jobId, $userId);
        $result->tags = $this->jobListingsTagRepository->getTagsByJobId($jobId);

        return new JobDetailResource($result);
    }

    /**
     * Update status job
     * 
     * @param string $jobId
     * @param string $status
     * @return void
     */
    public function updateStatusJob(string $jobId, string $status): void
    {
        if( ! $this->jobListingsRepository->existsById($jobId) ) throw new NotFoundException('Job not found');
        
        $userId = Auth::user()->user_id;
        $result = $this->jobListingsRepository->getJobDetailWithEmployerIdAndId($userId, $jobId);

        if( ! $result ) throw new NotFoundException("Job not found");

        if( ! in_array($status, ['publish', 'draft']) ) {
            throw new BadRequestException("Status must be publish or draft");
        }

        $status = $status == 'publish' ? true : false;

        $this->jobListingsRepository->updateStatusJob($jobId, $userId, $status);
    }
}