<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BeneficiaryInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $beneficiary;
    public $invitationLink;

    public function __construct($user, $beneficiary, $invitationLink)
    {
        $this->user = $user;
        $this->beneficiary = $beneficiary;
        $this->invitationLink = $invitationLink;
    }

    public function build()
    {
        return $this->subject("You've been invited to be a beneficiary")
            ->view('emails.beneficiary-invitation')
            ->with([
                'userName' => $this->user->name,
                'beneficiaryName' => $this->beneficiary->name,
                'invitationLink' => $this->invitationLink,
                'currentDate' => now()->format('F j, Y')
            ]);
    }
}
