<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeneficiaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_beneficiary_has_correct_relationships()
    {
        $user = User::factory()->create();
        $beneficiary = Beneficiary::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($beneficiary->user->is($user));
    }
}
