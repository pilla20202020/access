<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $campaign, $registration)
    {
        $this->data = $data;
        $this->campaign = $campaign;
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $campaign = $this->campaign;
        $registration = $this->registration;
        return $this->from($this->data['email'], $this->data['name'])->view('mail.registrationenquiry',compact('data','campaign','registration'));
    }
}
