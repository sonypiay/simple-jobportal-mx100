<?php

namespace App\Http\Resources\User\Employer\Jobs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppliedJobDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
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
            'candidate' => [
                'id' => $this->candidate_id,
                'name' => $this->candidate_name,
                'email' => $this->candidate_email,
                'phone' => $this->candidate_phone,
            ],
            'applicant' => [
                'id' => $this->id,
                'status' => $this->status,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
