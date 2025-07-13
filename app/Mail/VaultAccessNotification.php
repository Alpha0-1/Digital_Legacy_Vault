<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VaultAccessNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $vault;

    public function __construct($user, $vault)
    {
        $this->user = $user;
        $this->vault = $vault;
    }

    public function build()
    {
        return $this->subject("Your Vault Was Accessed")
            ->view('emails.vault-access-notification')
            ->with([
                'userName' => $this->user->name,
                'vaultTitle' => $this->vault->title,
                'accessTime' => now()->format('F j, Y H:i:s')
            ]);
    }
}
