<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_login_returns_token()
    {
        $user = User::factory()->create(['password' => 'password']);
        
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'test-device'
        ]);
        
        $response->assertOk()
            ->assertJsonStructure(['token', 'user']);
    }

    public function test_api_login_requires_valid_credentials()
    {
        $user = User::factory()->create();
        
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
            'device_name' => 'test-device'
        ]);
        
        $response->assertStatus(401);
    }
}
