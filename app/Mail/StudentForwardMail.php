<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentForwardMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $student,$admission,$college;

    public function __construct($student, $admission, $college)
    {
        //
        $this->student = $student;
        $this->admission = $admission;
        $this->college = $college;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $student = $this->student;
        $admission = $this->admission;
        $college = $this->college;
        return $this->from('noreply@consultancy.com','Consultancy')->view('emails.student.offerlettermail',compact('student','admission','college'));
    }
}
