<?php

namespace Tests\Feature\Inactivity;

use Tests\TestCase;
use App\Models\User;
use App\Models\Beneficiary;
use App\Services\InactivityService;

class LegacyReleaseTest extends TestCase
{
    public function test_legacy_releases_on_inactivity(): void
    {
        $user = User::factory()->create();
        $beneficiary = Beneficiary::factory()->create(['user_id' => $user->id]);
        
        // Mock inactivity
        $user->last_activity_at = now()->subDays(91);
        $user->save();
        
        $inactivityService = $this->mock(InactivityService::class);
        $inactivityService->shouldReceive('checkUserInactivity')
            ->once()
            ->andReturn(true);
        
        $this->artisan('inactivity:check');
        
        $this->assertDatabaseHas('legacy_releases', [
            'user_id' => $user->id,
            'status' => 'completed'
        ]);
    }
}
