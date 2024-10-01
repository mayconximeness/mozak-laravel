<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'uuid_code' => $this->uuid_code, 
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'complement' => $this->complement,
            'zipcode' => $this->zipcode,
            'number' => $this->number,
            'city' => $this->city,
            'state' => $this->state,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'max_subscription' => $this->max_subscription,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
