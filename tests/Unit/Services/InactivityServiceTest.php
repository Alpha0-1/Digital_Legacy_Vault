<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\InactivityService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InactivityServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_inactive_after_threshold()
    {
        $user = User::factory()->create([
            'last_activity_at' => now()->subDays(91),
        ]);

        $inactivityService = new InactivityService();
        $this->assertTrue($inactivityService->checkUserInactivity($user));
    }

    public function test_user_is_active_within_threshold()
    {
        $user = User::factory()->create([
            'last_activity_at' => now()->subDays(30),
        ]);

        $inactivityService = new InactivityService();
        $this->assertFalse($inactivityService->checkUserInactivity($user));
    }
}
