<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use RuntimeException;

class EncryptionService
{
    // Encrypt data with provided key
    public function encrypt(string $data, string $key): string
    {
        try {
            // Combine Laravel's built-in encryption with custom key
            return encrypt($data, $key);
        } catch (\Exception $e) {
            throw new RuntimeException('Encryption failed: ' . $e->getMessage());
        }
    }

    // Decrypt data with provided key
    public function decrypt(string $data, string $key): string
    {
        try {
            return decrypt($data, $key);
        } catch (\Exception $e) {
            throw new RuntimeException('Decryption failed: ' . $e->getMessage());
        }
    }

    // Generate secure encryption key
    public function generateKey(): string
    {
        return bin2hex(random_bytes(32)); // 256-bit key
    }

    // Verify encryption strength
    public function verifyEncryptionStrength(string $key): bool
    {
        // Check key length and complexity
        return strlen($key) >= 32 && 
               preg_match('/[A-Z]/', $key) && 
               preg_match('/[a-z]/', $key) && 
               preg_match('/[0-9]/', $key);
    }
}
