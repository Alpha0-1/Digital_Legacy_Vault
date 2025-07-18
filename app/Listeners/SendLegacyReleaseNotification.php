<?php

namespace App\Listeners;

use App\Events\LegacyReleaseTriggered;
use App\Mail\LegacyReleaseNotification;
use Illuminate\Support\Facades\Mail;

class SendLegacyReleaseNotification
{
    public function handle(LegacyReleaseTriggered $event): void
    {
        foreach ($event->user->beneficiaries as $beneficiary) {
            Mail::to($beneficiary->email)->send(new LegacyReleaseNotification(
                $event->user, 
                $beneficiary,
                $event->releaseDetails
            ));
        }
    }
}
