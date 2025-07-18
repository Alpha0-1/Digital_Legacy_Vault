<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogTest extends TestCase
{
    public function test_activity_log_belongs_to_user()
    {
        $activityLog = ActivityLog::factory()->create();
        $this->assertInstanceOf(User::class, $activityLog->user);
    }

    public function test_activity_log_has_action_attribute()
    {
        $activityLog = ActivityLog::factory()->create(['action' => 'vault_access']);
        $this->assertEquals('vault_access', $activityLog->action);
    }

    public function test_activity_log_has_description()
    {
        $activityLog = ActivityLog::factory()->create(['description' => 'User accessed vault']);
        $this->assertEquals('User accessed vault', $activityLog->description);
    }
}
