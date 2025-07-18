<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\EncryptionService;

class EncryptLegacyData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $key;

    public function __construct(array $data, string $key)
    {
        $this->data = $data;
        $this->key = $key;
    }

    public function handle(EncryptionService $encryptionService): void
    {
        $this->data['encrypted_content'] = $encryptionService->encrypt(
            json_encode($this->data['content']),
            $this->key
        );
        
        // Save encrypted data to storage or dispatch next job
    }
}
