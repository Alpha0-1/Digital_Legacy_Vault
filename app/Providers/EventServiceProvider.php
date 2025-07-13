<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\UserInactive' => [
            'App\Listeners\UpdateInactivityStatus',
        ],
        'App\Events\LegacyReleaseTriggered' => [
            'App\Listeners\SendLegacyReleaseNotification',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
