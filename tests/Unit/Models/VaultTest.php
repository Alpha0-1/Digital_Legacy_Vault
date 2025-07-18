<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Vault;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VaultTest extends TestCase
{
    use RefreshDatabase;

    public function test_vault_belongs_to_user()
    {
        $user = User::factory()->create();
        $vault = Vault::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($vault->user->is($user));
    }
}
