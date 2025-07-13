<?php

namespace App\Observers;

use App\Models\Vault;
use Illuminate\Support\Facades\Log;

class VaultObserver
{
    public function created(Vault $vault)
    {
        Log::info("Vault created: {$vault->id}", ['user_id' => $vault->user_id]);
    }

    public function deleted(Vault $vault)
    {
        Log::warning("Vault deleted: {$vault->id}", ['user_id' => $vault->user_id]);
    }
}
