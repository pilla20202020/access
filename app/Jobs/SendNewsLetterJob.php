<?php

namespace App\Jobs;

use App\Mail\SendNewsLetterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsLetterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $registration = $this->registration ;
        $newsletter = $this->newsletter;
        Mail::to($registration->email)->later(10,new SendNewsLetterMail($registration,$newsletter));
    }
}
