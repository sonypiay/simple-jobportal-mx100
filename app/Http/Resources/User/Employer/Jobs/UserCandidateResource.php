<?php

namespace App\Http\Resources\User\Employer\Jobs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->candidate_id,
            'name' => $this->candidate_name,
            'email' => $this->candidate_email,
            'phone' => $this->candidate_phone,
        ];
    }
}
