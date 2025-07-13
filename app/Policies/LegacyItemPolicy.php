<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LegacyItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class LegacyItemPolicy
{
    use HandlesAuthorization;

    public function view(User $user, LegacyItem $item)
    {
        return $item->vault->user_id === $user->id;
    }

    public function delete(User $user, LegacyItem $item)
    {
        return $item->vault->user_id === $user->id;
    }
}
