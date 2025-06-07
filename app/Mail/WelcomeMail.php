<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from('you@example.com')
            ->subject('Welcome!')
            ->view('emails.welcome');
    }
}
