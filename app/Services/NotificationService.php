<?php

namespace App\Services;

use App\Mail\InactivityWarning;
use App\Mail\BeneficiaryInvitation;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendInactivityWarning($user, $daysRemaining)
    {
        Mail::to($user->email)->send(new InactivityWarning($user, $daysRemaining));
        
        return true;
    }

    public function sendBeneficiaryInvitation($user, $beneficiary, $invitationLink)
    {
        Mail::to($beneficiary->email)->send(new BeneficiaryInvitation($user, $beneficiary, $invitationLink));
        
        return true;
    }

    public function sendVaultAccessNotification($user, $vault)
    {
        Mail::to($user->email)->send(new \App\Mail\VaultAccessNotification($user, $vault));
        
        return true;
    }
}
