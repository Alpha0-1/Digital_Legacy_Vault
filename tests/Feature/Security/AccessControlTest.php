<?php

namespace Tests\Feature\Security;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vault;
use App\Models\LegacyItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_owner_cannot_access_vault()
    {
        $owner = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $owner->id]);
        
        $nonOwner = User::factory()->create();
        $this->actingAs($nonOwner);
        
        $response = $this->get("/vaults/{$vault->id}");
        $response->assertForbidden();
    }

    public function test_admin_can_access_vault()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $vault = Vault::factory()->create();
        
        $this->actingAs($admin);
        $response = $this->get("/vaults/{$vault->id}");
        $response->assertOk();
    }
}
