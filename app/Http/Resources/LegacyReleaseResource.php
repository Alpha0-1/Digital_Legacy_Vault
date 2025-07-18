<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LegacyReleaseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'beneficiary' => $this->beneficiary->name,
            'vault_id' => $this->vault_id,
            'release_date' => $this->release_date?->toISOString(),
            'status' => $this->status,
            'reason' => $this->release_reason
        ];
    }
}
