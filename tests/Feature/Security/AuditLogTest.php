<?php

namespace Tests\Feature\Security;

use Tests\TestCase;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_audit_logs_are_created_for_user_actions()
    {
        $user = User::factory()->create();
        $user->name = 'Updated Name';
        $user->save();
        
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'updated_user',
            'description' => 'User updated'
        ]);
    }

    public function test_audit_logs_include_ip_and_user_agent()
    {
        $user = User::factory()->create();
        $user->name = 'Updated Name';
        $user->save();
        
        $log = ActivityLog::where('user_id', $user->id)->first();
        $this->assertNotNull($log->ip_address);
        $this->assertNotNull($log->user_agent);
    }
}
