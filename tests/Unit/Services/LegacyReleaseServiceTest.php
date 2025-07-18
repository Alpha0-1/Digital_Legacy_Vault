<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\LegacyReleaseService;
use App\Models\User;
use App\Models\Beneficiary;
use App\Models\LegacyRelease;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LegacyReleaseServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_legacy_release_triggers_for_user()
    {
        $user = User::factory()->create();
        $beneficiary = Beneficiary::factory()->create(['user_id' => $user->id]);
        $service = new LegacyReleaseService();
        $service->initiateLegacyRelease($user);

        $this->assertDatabaseHas('legacy_releases', ['user_id' => $user->id]);
    }
}
