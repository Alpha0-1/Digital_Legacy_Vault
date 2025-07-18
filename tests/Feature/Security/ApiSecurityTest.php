<?php

namespace Tests\Feature\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_requires_authentication()
    {
        $response = $this->get('/api/vaults');
        $response->assertUnauthorized();
    }

    public function test_api_has_rate_limiting()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        
        // Send 60 requests
        for ($i = 0; $i < 60; $i++) {
            $this->get('/api/vaults')->assertOk();
        }
        
        // The 61st should be rate limited
        $this->get('/api/vaults')->assertStatus(429);
    }

    public function test_api_restricts_access_to_owner()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $vault = Vault::factory()->create(['user_id' => $user1->id]);
        
        $this->actingAs($user2, 'sanctum');
        $this->get("/api/vaults/{$vault->id}")->assertForbidden();
    }
}
