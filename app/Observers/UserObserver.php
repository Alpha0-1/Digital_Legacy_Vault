<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function created(User $user): void
    {
        Log::info("New user registered: {$user->id}", ['email' => $user->email]);
    }

    public function deleted(User $user): void
    {
        Log::warning("User account deleted: {$user->id}");
    }
}
