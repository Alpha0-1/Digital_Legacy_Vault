<?php

namespace App\Services;

use App\Models\LegacyRelease;
use App\Models\Beneficiary;
use App\Models\Vault;
use App\Mail\LegacyReleaseNotification;
use Illuminate\Support\Facades\Mail;

class LegacyReleaseService
{
    public function initiateLegacyRelease($userId, $reason = 'inactivity')
    {
        // Get user and their vault
        $user = User::with(['vault', 'beneficiaries'])->findOrFail($userId);
        
        // Create release record
        $release = LegacyRelease::create([
            'user_id' => $user->id,
            'vault_id' => $user->vault->id,
            'release_date' => now(),
            'release_reason' => $reason,
            'status' => 'processing'
        ]);

        try {
            // Decrypt vault content
            $decryptedContent = $user->vault->decryptContent();
            
            // Send notifications to all beneficiaries
            foreach ($user->beneficiaries as $beneficiary) {
                // Send encrypted content to beneficiary
                $encryptedForBeneficiary = encrypt($decryptedContent, $beneficiary->encryption_key);
                
                Mail::to($beneficiary->email)->send(new LegacyReleaseNotification(
                    $user, 
                    $beneficiary, 
                    $encryptedForBeneficiary
                ));
                
                // Update release record
                $release->beneficiaries()->attach($beneficiary->id, [
                    'content_hash' => hash('sha256', $encryptedForBeneficiary)
                ]);
            }

            $release->update(['status' => 'completed']);
            
            return $release;
            
        } catch (\Exception $e) {
            $release->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);
            
            throw $e;
        }
    }
}
