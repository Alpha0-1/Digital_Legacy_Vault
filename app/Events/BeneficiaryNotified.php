<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BeneficiaryNotified implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public $beneficiary,
        public $vaultId
    ) {}

    public function broadcastOn()
    {
        return new PrivateChannel("vault.{$this->vaultId}");
    }

    public function broadcastWith()
    {
        return [
            'beneficiary' => $this->beneficiary,
            'vault_id' => $this->vaultId,
            'timestamp' => now()->toISOString(),
        ];
    }
}
