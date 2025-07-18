<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Models\User;
use App\Models\LegacyItem;
use App\Models\Vault;
use App\Policies\LegacyItemPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LegacyItemPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_delete_legacy_item()
    {
        $user = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $user->id]);
        $item = LegacyItem::factory()->create(['vault_id' => $vault->id]);
        
        $policy = new LegacyItemPolicy();
        $this->assertTrue($policy->delete($user, $item));
    }

    public function test_non_owner_cannot_delete_item()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $otherUser->id]);
        $item = LegacyItem::factory()->create(['vault_id' => $vault->id]);
        
        $policy = new LegacyItemPolicy();
        $this->assertFalse($policy->delete($user, $item));
    }
}
