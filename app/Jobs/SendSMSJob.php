<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $registration,$campaign,$sms_message;

    public function __construct($registration, $campaign, $sms_message)
    {
        //
        $this->registration = $registration;
        $this->campaign = $campaign;
        $this->sms_message = $sms_message;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $registration = $this->registration;
        $campaign = $this->campaign;
        $sms_message = $this->sms_message;
        $url = setting('sms_api') ?? 'https://sms.aakashsms.com/sms/v3/send';
        $data = array(
            'auth_token' => setting('sms_token') ?? '28a22c64768a49ee5f539fa2924a8c278bb9ff16d7798496adbb87278d1c7e70',
            'from' => setting('sms_from') ?? '31001',
            'to' => $registration->phone,
            'text' => $sms_message
        );
        $response = smsPost($url, $data);
    }
}
