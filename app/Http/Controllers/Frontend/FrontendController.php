<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsLetterJob;
use App\Mail\StudentEnquiryMail;
use App\Mail\StudentNotifyMail;
use App\Modules\Models\Blog\Blog;
use App\Modules\Models\Campaign\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\Qualification\Qualification;
use App\Modules\Models\Registration\Registration;
use App\Modules\Models\TestPreparation\TestPreparation;
use App\Modules\Models\User;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    protected $registration, $campaign, $qualification, $preparation;

    function __construct(User $user, Registration $registration, Campaign $campaign,  Qualification $qualification, TestPreparation $preparation)
    {
        $this->user = $user;
        $this->registration = $registration;
        $this->campaign = $campaign;
        $this->qualification = $qualification;
        $this->preparation = $preparation;

    }

    public function homepage()
    {
        $campaign = $this->campaign->latest()->take(1)->first();
        $campaign_course = explode(',', $campaign->offered_course);
        $qualifications = $this->qualification->all();
        $preparations = $this->preparation->all();
        return view('frontend.customer.form',compact('campaign','qualifications','preparations','campaign_course'));
    }

    public function store(Request $request, $headers, $user_agent)
    {
        $data = $request->all();
        if(isset($request->intrested_course)) {
            $result = collect($data['intrested_course']);
            $data['intrested_course'] = $result->implode(',');
        }
        $data['coupen_code'] = bin2hex(openssl_random_pseudo_bytes(3));
        $data['headers'] = $headers;
        $data['user_agent'] = $user_agent;
        if($registration = $this->registration->create($data)) {
            $campaign = $this->campaign->where('id',$request->campaign_id)->first();
            $web_message = $campaign->success_message;
            $sms_message = $campaign->sms_message;
            $email_message = $campaign->email_success;
            $todeliver_msg = Str::replace("<name>",$request->name, $web_message);
            $smsdeliver_msg = Str::replace("<name>",$request->name, $sms_message);
            $emaildeliver = Str::replace("<name>",$request->name, $email_message);

            $url = setting('sms_api') ?? 'https://sms.aakashsms.com/sms/v3/send';
            $data = array(
                'auth_token' => setting('sms_token') ?? '28a22c64768a49ee5f539fa2924a8c278bb9ff16d7798496adbb87278d1c7e70',
                'from' => setting('sms_from') ?? '31001',
                'to' => $request->phone,
                'text' => $smsdeliver_msg
            );
            $response = smsPost($url, $data);
            // $response = json_decode(smsPost($url, $data));
            // dd($response);
            // if ($response->response_code == 201) {
            //     return true;
            // } else {
            //     return false;
            // }
            Mail::to('prajwalbro@hotmail.com')->send(new StudentEnquiryMail($request->all(), $emaildeliver, $registration));
            Mail::to($request->email)->send(new StudentNotifyMail($request->all()));

            return redirect()->route('homepage')->withSuccess(trans($todeliver_msg));
        }
    }


    public function formByURL($url = null)
    {

        if ($url) {

            $campaign = $this->campaign->whereUrl($url)->first();

            if ($campaign == null) {
                return view('frontend.errors.404');
            }

            if ($campaign) {
                $campaign_course = explode(',', $campaign->offered_course);
            $qualifications = $this->qualification->all();
            $preparations = $this->preparation->all();
            return view('frontend.customer.form',compact('campaign','qualifications','preparations','campaign_course'));
            } else {
                return view('frontend.errors.404');
            }
        }
    }

    public function visit()
    {
        $campaigns = $this->campaign->get();
        $qualifications = $this->qualification->all();
        $preparations = $this->preparation->all();
        return view('frontend.visit.form',compact('campaigns','qualifications','preparations'));
    }

    public function visitStore(Request $request) {
        $data = $request->all();

        if($registration = $this->registration->create($data)) {
            $campaign = $this->campaign->where('id',$request->campaign_id)->first();
            $web_message = $campaign->success_message;
            $sms_message = $campaign->sms_message;
            $email_message = $campaign->email_success;
            $todeliver_msg = Str::replace("<name>",$request->name, $web_message);
            $smsdeliver_msg = Str::replace("<name>",$request->name, $sms_message);
            $emaildeliver = Str::replace("<name>",$request->name, $email_message);

            $url = setting('sms_api') ?? 'https://sms.aakashsms.com/sms/v3/send';
            $data = array(
                'auth_token' => setting('sms_token') ?? '28a22c64768a49ee5f539fa2924a8c278bb9ff16d7798496adbb87278d1c7e70',
                'from' => setting('sms_from') ?? '31001',
                'to' => $request->phone,
                'text' => $smsdeliver_msg
            );
            $response = smsPost($url, $data);
            // $response = json_decode(smsPost($url, $data));
            // dd($response);
            // if ($response->response_code == 201) {
            //     return true;
            // } else {
            //     return false;
            // }
            Mail::to('prajwalbro@hotmail.com')->send(new StudentEnquiryMail($request->all(), $emaildeliver, $registration));
            Mail::to($request->email)->send(new StudentNotifyMail($request->all()));

            return redirect()->route('visit')->withSuccess(trans($todeliver_msg));
        }
    }
}
