<?php

namespace App\Jobs;

use App\Mail\StudentForwardMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailToStudentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $student = $this->student;
        $admission = $this->admission;
        $college = $this->college;
        Mail::to($student->email)->later(10,new StudentForwardMail($student,$admission,$college));
    }
}
