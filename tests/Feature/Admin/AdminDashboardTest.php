<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        
        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertViewIs('admin.dashboard.index');
    }

    public function test_non_admin_cannot_access_dashboard()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }
}
