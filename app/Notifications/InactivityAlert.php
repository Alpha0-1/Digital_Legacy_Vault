<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InactivityAlert extends Notification
{
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new \App\Mail\InactivityWarning(
            $notifiable->email,
            now()->diffInDays($notifiable->last_activity_at),
            $notifiable->inactivitySettings->threshold_days
        ))->to($notifiable->email);
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'inactivity',
            'user_id' => $notifiable->id,
            'inactivity_days' => now()->diffInDays($notifiable->last_activity_at),
            'threshold_days' => $notifiable->inactivitySettings->threshold_days,
            'timestamp' => now()->toISOString(),
        ];
    }
}
