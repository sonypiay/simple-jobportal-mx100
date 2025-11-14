<?php

namespace App\Http\Resources\User\Employer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'description' => $this->description,
            'website' => $this->website,
            'company_size' => $this->company_size,
            'specialization' => $this->specialization,
            'industry' => $this->industry,
            'is_active' => $this->is_active,
            'date_register' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
    }
}
