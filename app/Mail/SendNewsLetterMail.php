<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewsLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $registration,$newsletter;

    public function __construct($registration, $newsletter)
    {
        //
        $this->registration = $registration;
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $registration = $this->registration ;
        $newsletter = $this->newsletter;

        return $this->from('noreply@consultancy.com','Consultancy')->view('mail.sendnewsletter',compact('registration','newsletter'));
    }
}
