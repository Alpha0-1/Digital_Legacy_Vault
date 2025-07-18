<?php

namespace Tests\Feature\Inactivity;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InactivityDetectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_gets_inactivity_notification()
    {
        $user = User::factory()->create([
            'last_activity_at' => now()->subDays(80),
            'inactivity_threshold_days' => 90
        ]);
        
        $this->artisan('inactivity:check');
        
        $this->assertDatabaseHas('notifications', [
            'type' => 'App\Notifications\InactivityAlert',
            'notifiable_id' => $user->id
        ]);
    }

    public function test_user_is_marked_inactive_after_threshold()
    {
        $user = User::factory()->create([
            'last_activity_at' => now()->subDays(91),
            'inactivity_threshold_days' => 90
        ]);
        
        $this->artisan('inactivity:check');
        
        $this->assertDatabaseHas('legacy_releases', [
            'user_id' => $user->id,
            'status' => 'pending'
        ]);
    }
}
