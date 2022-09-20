<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentForwardMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $agent_branch,$admission,$college, $student;

    public function __construct($agent_branch, $admission, $college, $student)
    {
        //
        $this->agent_branch = $agent_branch;
        $this->admission = $admission;
        $this->college = $college;
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $agent_branch = $this->agent_branch;
        $admission = $this->admission;
        $college = $this->college;
        $student = $this->student;
        return $this->from('noreply@consultancy.com','Consultancy')->view('emails.agent.offer_letter_of_student_mail',compact('agent_branch','admission','college','student'));
    }
}
