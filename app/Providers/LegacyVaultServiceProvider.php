<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LegacyReleaseService;
use App\Services\InactivityService;

class LegacyVaultServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LegacyReleaseService::class, function ($app) {
            return new LegacyReleaseService();
        });
        
        $this->app->singleton(InactivityService::class, function ($app) {
            return new InactivityService();
        });
    }

    public function boot(): void
    {
        // Register any boot-time logic
    }
}
