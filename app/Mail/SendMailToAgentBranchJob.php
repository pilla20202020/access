<?php

namespace App\Jobs;

use App\Mail\AgentForwardMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailToAgentBranchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $agent_branch = $this->agent_branch;
        $admission = $this->admission;
        $college = $this->college;
        $student = $this->student;
        Mail::to($agent_branch->email)->later(10,new AgentForwardMail($agent_branch,$admission,$college,$student));

    }
}
