<?php

namespace App\Http\Resources\Jobs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $routeName = $request->route()->getName();

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->job_category_id,
            'is_publish' => $this->is_publish,
            'location' => $this->location,
            'employment_type' => $this->employment_type,
            'level_experience' => $this->level_experience,
            'category' => $this->category,
            'last_updated' => $this->updated_at->format('Y-m-d H:i:s'),
            'description' => $this->description,
            'qualifications' => $this->qualifications,
            'salary' => [
                'min' => $this->minimum_salary,
                'max' => $this->maximum_salary,
            ],
        ];

        if( $routeName == 'api.jobs.detail' ) {
            $data['company'] = $this->company_name;
            $data['total_applied'] = $this->total_applied_jobs;
            $data['tags'] = $this->tags;
        }

        return $data;
    }
}
