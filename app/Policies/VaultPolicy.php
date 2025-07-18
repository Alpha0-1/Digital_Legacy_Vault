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

    public function delete(User $user, Vault $vault)
    {
        return $vault->user_id === $user->id && $vault->legacyItems()->count() === 0;
    }
}
