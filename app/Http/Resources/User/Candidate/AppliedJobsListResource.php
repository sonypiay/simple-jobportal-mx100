<?php

namespace App\Http\Resources\User\Candidate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppliedJobsListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'apply_id' => $this->applied_job_id,
            'job_detail' => [
                'id' => $this->job_id,
                'title' => $this->job_title,
                'location' => $this->location,
                'employment_type' => $this->employment_type,
                'level_experience' => $this->level_experience,
                'company_name' => $this->company_name,
                'category' => $this->category,
                'status' => $this->status,
            ],
            'apply_date' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}
