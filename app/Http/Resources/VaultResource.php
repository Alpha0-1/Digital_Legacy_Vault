<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VaultResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'security_level' => $this->security_level,
            'created_at' => $this->created_at->toISOString(),
            'beneficiaries' => BeneficiaryResource::collection($this->whenLoaded('beneficiaries')),
            'legacy_items' => LegacyItemResource::collection($this->whenLoaded('legacyItems')),
        ];
    }
}
