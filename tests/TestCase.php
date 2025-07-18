O[O<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpTestApplication();
    }

    protected function setUpTestApplication()
    {
        // Set up any test-specific configurations
        config(['app.env' => 'testing']);
        config(['database.default' => 'sqlite']);
        config(['database.connections.sqlite.database' => ':memory:']);
        
        // Initialize Sanctum for API testing
        \Laravel\Sanctum\Sanctum::actingAs(
            \App\Models\User::factory()->create()
        );
    }

    protected function getTestUser()
    {
        return \App\Models\User::factory()->create();
    }

    protected function getTestVault($user = null)
    {
        $user = $user ?? $this->getTestUser();
        return \App\Models\Vault::factory()->create(['user_id' => $user->id]);
    }

    protected function getTestLegacyItem($vault = null)
    {
        $vault = $vault ?? $this->getTestVault();
        return \App\Models\LegacyItem::factory()->create(['vault_id' => $vault->id]);
    }
}
