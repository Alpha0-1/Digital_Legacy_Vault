<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Jobs\ProcessLegacyRelease;
use App\Services\LegacyReleaseService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessLegacyReleaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_legacy_release_job_dispatches_correctly()
    {
        $user = User::factory()->create();
        $job = new ProcessLegacyRelease($user);
        $service = \Mockery::mock(LegacyReleaseService::class);

        $service->shouldReceive('initiateLegacyRelease')->once()->with($user);
        $job->handle($service);

        $this->assertTrue(true);
    }
}
