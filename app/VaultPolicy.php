<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vault;
use Illuminate\Auth\Access\HandlesAuthorization;

class VaultPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Vault $vault)
    {
        return $vault->user_id === $user->id;
    }

    public function update(User $user, Vault $vault)
    {
        return $vault->user_id === $user->id;
    }

    public function release(User $user, Vault $vault)
    {
        // Admin can release vaults in case of emergency
        return $user->is_admin || $vault->user_id === $user->id;
    }
}
