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
    public function __construct($data, $emaildeliver, $registration)
    {
        $this->data = $data;
        $this->emaildeliver = $emaildeliver;
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
        $emaildeliver = $this->emaildeliver;
        $registration = $this->registration;
        return $this->from($this->data['email'], $this->data['name'])->view('mail.registrationenquiry',compact('data','emaildeliver','registration'));
    }
}
