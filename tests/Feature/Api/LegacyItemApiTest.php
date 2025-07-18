<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Beneficiary;
use App\Models\LegacyItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LegacyItemApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_legacy_item()
    {
        $user = User::factory()->create();
        $beneficiary = Beneficiary::factory()->create(['user_id' => $user->id]);
        
        $response = $this->actingAs($user)->postJson('/api/legacy-items', [
            'title' => 'Will',
            'content' => 'My last will',
            'item_type' => 'document',
            'beneficiaries' => [$beneficiary->id]
        ]);
        
        $response->assertCreated();
        $this->assertDatabaseHas('legacy_items', [
            'title' => 'Will',
            'item_type' => 'document'
        ]);
    }

    public function test_invalid_encryption_key_fails()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->postJson('/api/vaults', [
            'title' => 'Secret Vault',
            'security_level' => 'high',
            'encryption_key' => 'short-key',
            'content' => 'Secret info'
        ]);
        
        $response->assertInvalid(['encryption_key']);
    }
}
