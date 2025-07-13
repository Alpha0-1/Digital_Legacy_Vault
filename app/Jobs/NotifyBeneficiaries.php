<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\NotificationService;

class NotifyBeneficiaries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $beneficiaries;

    public function __construct($user, $beneficiaries)
    {
        $this->user = $user;
        $this->beneficiaries = $beneficiaries;
    }

    public function handle(NotificationService $notificationService)
    {
        foreach ($this->beneficiaries as $beneficiary) {
            $notificationService->sendBeneficiaryInvitation($this->user, $beneficiary, route('beneficiary.accept', $beneficiary->id));
        }
    }
}
