<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$active_token)
    {
        $this->data = $data;
        $this->active_token = $active_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('vanquoc26520@gmail.com')
        ->view('mail.active_account_mail')
        ->with([
            'data'=> $this->data,
            'active_token' => $this->active_token
        ]);
    }
}
