<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LegacyItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'item_type' => $this->item_type,
            'created_at' => $this->created_at->toISOString(),
            'beneficiaries' => BeneficiaryResource::collection($this->whenLoaded('beneficiaries'))
        ];
    }
}
