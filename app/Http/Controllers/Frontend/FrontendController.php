<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\StudentEnquiryMail;
use App\Mail\StudentNotifyMail;
use App\Models\Blog\Blog;
use App\Models\Campaign\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Customer\Customer;
use App\Models\Registration\Registration;
use App\User;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    protected $customer, $registration, $campaign;

    function __construct(Customer $customer, User $user, Registration $registration, Campaign $campaign)
    {
        $this->customer = $customer;
        $this->user = $user;
        $this->registration = $registration;
        $this->campaign = $campaign;

    }

    public function homepage()
    {
        $campaign = Campaign::latest()->take(1)->first();
        return view('frontend.customer.form',compact('campaign'));
    }

    public function store(Request $request)
    {
       // dd($request->all());
        if($registration = $this->registration->create($request->all())) {
            $campaign = $this->campaign->where('id',$request->campaign_id)->first();
            $message = $campaign->success_message;
            $todeliver_msg = Str::replace("name",$request->name, $message);

            $url = 'https://aakashsms.com/admin/public/sms/v1/send';
            $data = array(
                'auth_token' => '28a22c64768a49ee5f539fa2924a8c278bb9ff16d7798496adbb87278d1c7e70',
                'from' => '31001',
                'to' => $request->phone,
                'text' => $campaign->sms_message
            );
            smsPost($url, $data);
            // $response = json_decode(smsPost($url, $data));
            // dd($response);
            // if ($response->response_code == 201) {
            //     return true;
            // } else {
            //     return false;
            // }
            Mail::to('prajwalbro@hotmail.com')->send(new StudentEnquiryMail($request->all()));
            Mail::to($request->email)->send(new StudentNotifyMail($request->all()));

            return redirect()->route('homepage')->withSuccess(trans($todeliver_msg));
        }
    }
}
