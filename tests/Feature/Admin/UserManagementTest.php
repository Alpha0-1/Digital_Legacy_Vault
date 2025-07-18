<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_user()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();
        
        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $user))
            ->assertRedirect();
            
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_non_admin_cannot_delete_user()
    {
        $nonAdmin = User::factory()->create();
        $user = User::factory()->create();
        
        $this->actingAs($nonAdmin)
            ->delete(route('admin.users.destroy', $user))
            ->assertForbidden();
    }
}
