<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeneficiaryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Beneficiary $beneficiary)
    {
        return $beneficiary->user_id === $user->id;
    }

    public function update(User $user, Beneficiary $beneficiary)
    {
        return $beneficiary->user_id === $user->id;
    }

    public function delete(User $user, Beneficiary $beneficiary)
    {
        return $beneficiary->user_id === $user->id;
    }
}
