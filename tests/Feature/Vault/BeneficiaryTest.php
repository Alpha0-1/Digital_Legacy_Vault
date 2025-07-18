<?php

namespace Tests\Feature\Vault;

use Tests\TestCase;
use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeneficiaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_beneficiary_to_vault()
    {
        $user = User::factory()->create();
        $vault = $user->vault()->create([
            'title' => 'Personal Vault',
            'security_level' => 'high',
            'encryption_key' => 'test1234test1234test1234'
        ]);
        
        $this->actingAs($user)
            ->post(route('beneficiaries.store'), [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'relationship' => 'Spouse',
                'vault_id' => $vault->id,
            ])
            ->assertRedirect();
            
        $this->assertDatabaseHas('beneficiaries', [
            'email' => 'jane@example.com',
            'vault_id' => $vault->id
        ]);
    }

    public function test_beneficiary_email_must_be_unique()
    {
        $user = User::factory()->create();
        $vault = $user->vault()->create([
            'title' => 'Personal Vault',
            'security_level' => 'high',
            'encryption_key' => 'test1234test1234test1234'
        ]);
        
        Beneficiary::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'relationship' => 'Spouse',
            'vault_id' => $vault->id,
            'user_id' => $user->id
        ]);
        
        $this->actingAs($user)
            ->post(route('beneficiaries.store'), [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'relationship' => 'Spouse',
                'vault_id' => $vault->id,
            ])
            ->assertInvalid(['email']);
    }
}
