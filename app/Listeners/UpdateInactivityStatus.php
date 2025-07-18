<?php

namespace App\Listeners;

use App\Events\VaultAccessed;
use App\Models\InactivitySetting;

class UpdateInactivityStatus
{
    public function handle(VaultAccessed $event)
    {
        $setting = InactivitySetting::firstOrNew([
            'user_id' => $event->userId
        ]);

        $setting->last_activity_at = now();
        $setting->release_status = 'pending';
        $setting->save();
    }
}
