<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SecurityAlert extends Notification implements ShouldQueue
{
    use Queueable;

    private $alertDetails;

    public function __construct(array $alertDetails)
    {
        $this->alertDetails = $alertDetails;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'security_alert',
            'severity' => $this->alertDetails['severity'],
            'message' => $this->alertDetails['message'],
            'timestamp' => now()->toISOString()
        ];
    }
}
