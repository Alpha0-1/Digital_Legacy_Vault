<?php

namespace App\Services;

use App\Models\Vault;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VaultSecurityService
{
    public function verifyVaultIntegrity(Vault $vault)
    {
        try {
            // Verify encryption
            if (!$this->verifyEncryption($vault->encryption_key)) {
                Log::warning("Vault encryption verification failed: {$vault->id}");
                return false;
            }
            
            // Verify file integrity
            if ($vault->hasFile() && !$this->verifyFileIntegrity($vault)) {
                Log::warning("Vault file integrity verification failed: {$vault->id}");
                return false;
            }
            
            return true;
            
        } catch (\Exception $e) {
            Log::error("Vault security verification error: " . $e->getMessage());
            return false;
        }
    }

    protected function verifyEncryption($key)
    {
        // Test encryption/decryption cycle
        $testData = 'vault_integrity_check';
        $encrypted = encrypt($testData, $key);
        $decrypted = decrypt($encrypted, $key);
        
        return $decrypted === $testData;
    }

    protected function verifyFileIntegrity(Vault $vault)
    {
        // Verify stored file hash
        $filePath = "vaults/{$vault->id}/content.enc";
        
        if (!Storage::exists($filePath)) {
            return false;
        }
        
        $fileHash = Storage::hash($filePath);
        return $fileHash === $vault->content_hash;
    }
}
