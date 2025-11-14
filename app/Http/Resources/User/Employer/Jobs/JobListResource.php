<?php

namespace App\Http\Resources\User\Employer\Jobs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->job_category_id,
            'is_publish' => $this->is_publish,
            'location' => $this->location,
            'employment_type' => $this->employment_type,
            'level_experience' => $this->level_experience,
            'category' => $this->category,
            'last_updated' => $this->updated_at->format('Y-m-d H:i:s'),
            'total_applied' => $this->total_applied_jobs,
        ];
    }
}
