<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class LogUserActivity
{
    public function handle(Login $event): void
    {
        $event->user->activityLogs()->create([
            'action' => 'login',
            'description' => 'User logged in',
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent()
        ]);
    }
}
