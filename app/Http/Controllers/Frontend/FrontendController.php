<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\StudentEnquiryMail;
use App\Mail\StudentNotifyMail;
use App\Modules\Models\Blog\Blog;
use App\Modules\Models\Campaign\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\Registration\Registration;
use App\Modules\Models\User;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    protected $registration, $campaign;

    function __construct(User $user, Registration $registration, Campaign $campaign)
    {
        $this->user = $user;
        $this->registration = $registration;
        $this->campaign = $campaign;

    }

    public function homepage()
    {
        $campaign = $this->campaign->latest()->take(1)->first();
        return view('frontend.customer.form',compact('campaign'));
    }

    public function store(Request $request)
    {

        if($registration = $this->registration->create($request->all())) {
            $campaign = $this->campaign->where('id',$request->campaign_id)->first();
            $web_message = $campaign->success_message;
            $sms_message = $campaign->sms_message;
            $todeliver_msg = Str::replace("<name>",$request->name, $web_message);
            $smsdeliver_msg = Str::replace("<name>",$request->name, $sms_message);

            $url = 'https://aakashsms.com/admin/public/sms/v1/send';
            $data = array(
                'auth_token' => '28a22c64768a49ee5f539fa2924a8c278bb9ff16d7798496adbb87278d1c7e70',
                'from' => '31001',
                'to' => $request->phone,
                'text' => $smsdeliver_msg
            );
            smsPost($url, $data);
            // $response = json_decode(smsPost($url, $data));
            // dd($response);
            // if ($response->response_code == 201) {
            //     return true;
            // } else {
            //     return false;
            // }
            Mail::to('prajwalbro@hotmail.com')->send(new StudentEnquiryMail($request->all(), $campaign, $registration));
            Mail::to($request->email)->send(new StudentNotifyMail($request->all()));

            return redirect()->route('homepage')->withSuccess(trans($todeliver_msg));
        }
    }
}
