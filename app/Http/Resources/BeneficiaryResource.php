<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'relationship' => $this->relationship,
            'verified' => $this->is_verified,
            'legacy_items_count' => $this->legacyItems->count()
        ];
    }
}
