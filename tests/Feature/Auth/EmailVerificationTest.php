<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InactivityWarning;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_flow()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        
        $this->actingAs($user)
            ->get(route('verification.notice'))
            ->assertSee('Verify Your Email');
            
        $this->post(route('verification.send'))
            ->assertSessionHas('status', 'verification-link-sent');
            
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_unverified_users_cant_access_vault()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        
        $this->actingAs($user)
            ->get(route('vault.index'))
            ->assertRedirect(route('verification.notice'));
    }
}
