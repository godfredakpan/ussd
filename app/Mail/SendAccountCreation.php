<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccountCreation extends Mailable
{
    use Queueable, SerializesModels;
    private $name;
    private $company_id;
    private $token;
    private $company_ref_code;
    private $company_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $company_id, $token, $company_ref_code, $company_name)
    {
        $this->name = $name;
        $this->company_id = $company_id;
        $this->token = $token;
        $this->company_ref_code = $company_ref_code;
        $this->company_name = $company_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("hello@diagnosemeafrica.com",'DiagnoseMe')
        ->subject("{$this->company_name} has invited you to complete your profile.")
        ->with('name', $this->name)
        ->with('company_id', $this->company_id)
        ->with('token', $this->token)
        ->with('company_ref_code', $this->company_ref_code)
        ->with('company_name', $this->company_name)
        ->view('emails.account-creation');
    }
}
