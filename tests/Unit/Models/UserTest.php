<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_correct_traits()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        $this->assertTrue(property_exists($user, 'is_admin'));
    }
}
