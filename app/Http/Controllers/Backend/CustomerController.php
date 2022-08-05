<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Campaign\Campaign;
use App\Models\Registration\Registration;
use App\User;
use Illuminate\Support\Str;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $customer, $registration, $campaign;

    function __construct(Customer $customer, User $user, Registration $registration, Campaign $campaign)
    {
        $this->customer = $customer;
        $this->user = $user;
        $this->registration = $registration;
        $this->campaign = $campaign;

    }
    public function customerForm()
    {
        return view('frontend.customer.form');
    }

    public function index()
    {
        //
        $registrations = $this->registration->orderBy('created_at', 'desc')->get();
        return view('backend.registration.index', compact('registrations'));
    }


    public function show($id)
    {
        $registration = $this->registration->where('id',$id)->first();
        return view('backend.registration.show', compact('registration'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            // $response = json_decode(httpPost($url, $data));
            // dd($response);
            // if ($response->response_code == 201) {
            //     return true;
            // } else {
            //     return false;
            // }
            return redirect()->route('homepage')->withSuccess(trans($todeliver_msg));
        }
    }

    public function destroy($id)
    {
        $registration = Registration::where('id', $id)->first();
        $registration->delete();
        return redirect()->route('registration.index');
    }



}
