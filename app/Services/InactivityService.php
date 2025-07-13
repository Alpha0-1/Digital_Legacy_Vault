<?php

namespace App\Services;

use App\Models\User;
use App\Models\InactivitySetting;
use Carbon\Carbon;

class InactivityService
{
    public function checkUserInactivity(User $user)
    {
        $setting = $user->inactivitySetting;
        $lastActive = $user->last_activity_at ?? $user->updated_at;
        $inactivityDays = now()->diffInDays($lastActive);
        
        // Check if user is inactive beyond threshold
        if ($inactivityDays >= $setting->inactivity_threshold_days) {
            return true;
        }
        
        // Check if we need to send notification
        $daysRemaining = $setting->inactivity_threshold_days - $inactivityDays;
        if (in_array($daysRemaining, $setting->notification_days_before)) {
            SendInactivityNotification::dispatch($user, $daysRemaining);
        }
        
        return false;
    }

    public function sendInactivityNotification(User $user, int $daysRemaining)
    {
        // Calculate release date
        $releaseDate = now()->addDays($daysRemaining);
        
        // Send notification to user
        $user->notify(new \App\Notifications\InactivityAlert($daysRemaining, $releaseDate));
        
        // Log activity
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'inactivity_notification_sent',
            'description' => "User notified about inactivity. Legacy will be released in {$daysRemaining} days.",
            'ip_address' => request()->ip()
        ]);
    }
}
