<?php

namespace Tests\Feature\Vault;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vault;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VaultManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_vault()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('vault.store'), [
            'title' => 'My Legacy',
            'security_level' => 'high',
            'encryption_key' => 'test1234test1234test1234',
        ]);
        
        $response->assertRedirect(route('vault.index'));
        $this->assertDatabaseHas('vaults', [
            'title' => 'My Legacy',
            'security_level' => 'high'
        ]);
    }

    public function test_vault_requires_valid_encryption_key()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('vault.store'), [
            'title' => 'Secret Vault',
            'security_level' => 'high',
            'encryption_key' => 'short-key',
        ]);
        
        $response->assertInvalid(['encryption_key']);
    }
}
