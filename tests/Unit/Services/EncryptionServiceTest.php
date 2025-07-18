<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\EncryptionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EncryptionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_data_can_be_encrypted_and_decrypted()
    {
        $service = new EncryptionService();
        $key = $service->generateKey();
        $encrypted = $service->encrypt('Secret', $key);
        $decrypted = $service->decrypt($encrypted, $key);

        $this->assertEquals('Secret', $decrypted);
    }

    public function test_invalid_key_throws_exception()
    {
        $this->expectException(\RuntimeException::class);
        $service = new EncryptionService();
        $service->decrypt('invalid', 'short-key');
    }
}
