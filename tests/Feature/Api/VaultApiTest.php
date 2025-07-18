<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vault;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VaultApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_can_retrieve_vault()
    {
        $user = User::factory()->create();
        $vault = $user->vault()->create([
            'title' => 'Personal Vault',
            'security_level' => 'high',
            'encryption_key' => 'test1234test1234test1234'
        ]);
        
        $this->actingAs($user, 'sanctum')
            ->getJson("/api/vaults/{$vault->id}")
            ->assertOk()
            ->assertJson([
                'id' => $vault->id,
                'title' => 'Personal Vault'
            ]);
    }

    public function test_api_can_create_vault()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/vaults', [
                'title' => 'New Vault',
                'security_level' => 'high',
                'encryption_key' => 'test1234test1234test1234',
                'content' => 'Secret information'
            ]);
            
        $response->assertCreated()
            ->assertJson(['title' => 'New Vault']);
    }
}
