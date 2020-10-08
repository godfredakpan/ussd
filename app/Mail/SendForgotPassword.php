<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    private $userName;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $token)
    {
        $this->userName = $userName;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("hello@diagnosemeafrica.com",'DiagnoseMe')
        ->subject("54gene Corporate Portal")
        ->with('userName', $this->userName)
        ->with('token', $this->token)
        ->view('emails.forgot-password');
    }
}
