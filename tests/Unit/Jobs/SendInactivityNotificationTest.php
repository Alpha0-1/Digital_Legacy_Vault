<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Jobs\SendInactivityNotification;
use App\Services\NotificationService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendInactivityNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_inactivity_notification_is_sent()
    {
        $user = User::factory()->create();
        $service = \Mockery::mock(NotificationService::class);
        $service->shouldReceive('sendInactivityWarning')->once()->with($user, 7);
        
        $job = new SendInactivityNotification(['user' => $user, 'daysRemaining' => 7]);
        $job->handle($service);
    }
}
