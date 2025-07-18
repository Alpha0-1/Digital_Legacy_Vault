<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\LegacyItem;
use App\Models\Vault;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LegacyItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_legacy_item_belongs_to_vault()
    {
        $user = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $user->id]);
        $item = LegacyItem::factory()->create(['vault_id' => $vault->id]);

        $this->assertTrue($item->vault->is($vault));
    }
}
