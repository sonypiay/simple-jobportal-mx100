<?php

namespace App\Http\Resources\User\Employer\Jobs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'candidate_id' => $this->candidate_id,
            'candidate_name' => $this->candidate_name,
            'candidate_email' => $this->candidate_email,
            'candidate_phone' => $this->candidate_phone,
            'apply_id' => $this->applied_job_id,
            'status' => $this->status,
            'apply_date' => $this->applied_date,
            'cover_letter' => Storage::url('apply_job/cover_letter/' . $this->cover_letter),
            'resume' => Storage::url('apply_job/resume/' . $this->resume),
        ];
    }
}
