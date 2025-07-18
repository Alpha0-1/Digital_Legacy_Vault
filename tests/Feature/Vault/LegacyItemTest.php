<?php

namespace Tests\Feature\Vault;

use Tests\TestCase;
use App\Models\User;
use App\Models\LegacyItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LegacyItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_legacy_item()
    {
        $user = User::factory()->create();
        $vault = $user->vault()->create([
            'title' => 'Personal Vault',
            'security_level' => 'high',
            'encryption_key' => 'test1234test1234test1234'
        ]);
        
        $this->actingAs($user)
            ->post(route('vault.items.store'), [
                'title' => 'Will',
                'content' => 'My last will',
                'item_type' => 'document',
            ])
            ->assertRedirect();
            
        $this->assertDatabaseHas('legacy_items', [
            'title' => 'Will',
            'item_type' => 'document'
        ]);
    }

    public function test_legacy_item_requires_valid_vault()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('vault.items.store'), [
            'title' => 'Invalid',
            'content' => 'Test',
            'item_type' => 'document',
        ]);
        
        $response->assertForbidden();
    }
}
