<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LegacyReleaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $beneficiary;
    public $content;

    public function __construct($user, $beneficiary, $content)
    {
        $this->user = $user;
        $this->beneficiary = $beneficiary;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject("Legacy Release from {$this->user->name}")
            ->view('emails.legacy-release')
            ->with([
                'userName' => $this->user->name,
                'beneficiaryName' => $this->beneficiary->name,
                'content' => $this->content,
                'releaseDate' => now()->format('F j, Y')
            ]);
    }
}
