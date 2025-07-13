<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class LegacyReleaseTriggered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $releaseDetails;

    public function __construct(User $user, array $releaseDetails)
    {
        $this->user = $user;
        $this->releaseDetails = $releaseDetails;
    }
}
