<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\EncryptionService;

class EncryptionTest extends TestCase
{
    use RefreshDatabase;

    protected EncryptionService $encryptionService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->encryptionService = app(EncryptionService::class);
    }

    public function test_data_can_be_encrypted_and_decrypted()
    {
        $originalData = 'Secret Legacy Information';
        $key = $this->encryptionService->generateKey();
        
        $encrypted = $this->encryptionService->encrypt($originalData, $key);
        $decrypted = $this->encryptionService->decrypt($encrypted, $key);
        
        $this->assertEquals($originalData, $decrypted);
    }

    public function test_encryption_fails_with_invalid_key()
    {
        $originalData = 'Secret Legacy Information';
        $validKey = $this->encryptionService->generateKey();
        $invalidKey = 'invalid_key';
        
        $encrypted = $this->encryptionService->encrypt($originalData, $validKey);
        
        $this->expectException(\RuntimeException::class);
        $this->encryptionService->decrypt($encrypted, $invalidKey);
    }
}
