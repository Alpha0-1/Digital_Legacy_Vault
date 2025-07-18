<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\VaultSecurityService;
use App\Models\Vault;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class VaultSecurityServiceTest extends TestCase
{
    protected VaultSecurityService $vaultSecurityService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->vaultSecurityService = app(VaultSecurityService::class);
    }

    public function test_vault_integrity_check_passes_with_valid_encryption()
    {
        $vault = Vault::factory()->make([
            'encryption_key' => 'valid_key_12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123......<think>
</think>

This batch includes critical components for:
- Security scanning automation
- Security incident response
- Vault security verification
- API routes
- Language support
- Docker development configuration
- Security headers middleware
- Admin UI components
- Security testing

Would you like the next batch? I can continue with:
- Remaining JavaScript components
- Additional test files
- Security documentation
- Vault management logic
- Inactivity monitoring files
