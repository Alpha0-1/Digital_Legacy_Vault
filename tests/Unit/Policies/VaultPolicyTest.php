<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vault;
use App\Policies\VaultPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VaultPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_vault()
    {
        $user = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $user->id]);
        
        $policy = new VaultPolicy();
        $this->assertTrue($policy->view($user, $vault));
    }

    public function test_non_owner_cannot_view_vault()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $otherUser->id]);
        
        $policy = new VaultPolicy();
        $this->assertFalse($policy->view($user, $vault));
    }
}
