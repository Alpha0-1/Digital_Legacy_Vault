<?php

namespace App\Providers;

use App\Models\Vault;
use App\Policies\VaultPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Vault::class => VaultPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
        $this->gate('viewAdmin', fn ($user) => $user->is_admin);
    }
}
