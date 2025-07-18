<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class LegacyReleased extends Notification implements ShouldQueue
{
    use Queueable;

    protected array $releaseDetails;

    public function __construct(array $releaseDetails)
    {
        $this->releaseDetails = $releaseDetails;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'legacy_released',
            'vault_id' => $this->releaseDetails['vault_id'],
            'release_date' => now()->toISOString()
        ];
    }
}
