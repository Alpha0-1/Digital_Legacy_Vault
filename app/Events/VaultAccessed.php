<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VaultAccessed
{
    use Dispatchable, SerializesModels, InteractsWithSockets;

    public function __construct(
        public $userId,
        public $vaultId,
        public $ipAddress
    ) {}

    public function broadcastOn()
    {
        return [];
    }
}
