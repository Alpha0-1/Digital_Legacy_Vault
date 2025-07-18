<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InactivityWarning extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $beneficiary,
        public $inactivityDays,
        public $daysRemaining
    ) {}

    public function build()
    {
        return $this->from('security@digitallegacy.io')
            ->subject('Inactivity Warning')
            ->markdown('emails.inactivity-warning')
            ->with([
                'beneficiary' => $this->beneficiary,
                'inactivity_days' => $this->inactivityDays,
                'days_remaining' => $this->daysRemaining,
            ]);
    }
}
