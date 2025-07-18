<?php

namespace App\Jobs;

use App\Models\InactivitySetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendInactivityNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $setting;

    public function __construct(InactivitySetting $setting)
    {
        $this->setting = $setting;
    }

    public function handle()
    {
        $user = $this->setting->user;
        $daysRemaining = $this->setting->threshold_days - now()->diffInDays($this->setting->last_activity_at);

        if ($daysRemaining <= 0) {
            ProcessLegacyRelease::dispatch($this->setting->release);
            return;
        }

        $user->notify(new \App\Notifications\InactivityAlert($daysRemaining));
    }
}
