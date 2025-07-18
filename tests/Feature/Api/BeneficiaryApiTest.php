<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeneficiaryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_beneficiary_crud_operations()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->postJson('/api/beneficiaries', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'relationship' => 'Sister'
        ])->assertCreated();
        
        $this->assertDatabaseHas('beneficiaries', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com'
        ]);
    }

    public function test_beneficiary_requires_valid_email()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->postJson('/api/beneficiaries', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'relationship' => 'Brother'
        ])->assertInvalid(['email']);
    }
}
