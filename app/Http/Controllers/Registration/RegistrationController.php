<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Modules\Models\FollowUp\FollowUp;
use App\Modules\Models\LeadCategory\LeadCategory;
use Illuminate\Http\Request;
use App\Modules\Models\Registration\Registration;
use App\Modules\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    protected $customer, $registration, $followup, $leadCategory;

    function __construct(User $user, Registration $registration, FollowUp $followup, LeadCategory $leadCategory)
    {
        $this->user = $user;
        $this->registration = $registration;
        $this->followup = $followup;
        $this->leadCategory = $leadCategory;

    }
    public function customerForm()
    {
        return view('frontend.customer.form');
    }

    public function index()
    {
        //
        if(Auth::user()->hasRole('Consultancy')) {
            $registrations = $this->registration->orderBy('created_at', 'desc')->where('preffered_location', Auth()->user()->location()->slug)->get();
        } else {
            $registrations = $this->registration->orderBy('created_at', 'desc')->get();
        }
        $leadCategories = $this->leadCategory->get();
        return view('registration.index', compact('registrations','leadCategories'));
    }


    public function show($id)
    {
        $registration = $this->registration->where('id',$id)->first();
        return view('registration.show', compact('registration'));

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
            Toastr()->success('Registration Send Successfully','Success');
            return redirect()->route('homepage');
        }
    }

    public function update(Request $request) {
        try{
            $registration = $this->registration->findOrFail($request->registration_id);
            $registration->update($request->all());
            Toastr()->success('Registration Updated Successfully','Success');
            return redirect()->route('registration.index');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('registration.index')->with('error', $ex->getMessage());
        }
    }



    public function destroy($id)
    {
        $registration = Registration::where('id', $id)->first();
        $registration->delete();
        Toastr()->success('Registration Deleted Successfully','Success');
        return redirect()->route('registration.index');
    }

    // Get FollowUp
    public function viewFollowUp(Request $request) {
        if($followup = $this->followup->where('refrence_id', $request->registration_id)->where('follow_up_type','registration')->latest()->get())
        {
            return response()->json([
                'data' => $followup,
                'status' => true,
                'message' => "Commission Generated Successfully."
            ]);
        }
    }

    public function addFollowUp(Request $request) {
        try{
            $registration = $this->registration->where('id',$request->refrence_id);
            if($registration->count() == 1) {
                $registration_data['leadcategory_id'] = $request->leadcategory_id;
                $registration->update($registration_data);
            }
            $followup_data['refrence_id'] = $request->refrence_id;
            $followup_data['follow_up_name'] = $request->follow_up_name ?? null;
            $followup_data['follow_up_type'] = $request->follow_up_type ?? null;
            $followup_data['follow_up_by'] = Auth()->user()->name ?? null;
            $followup_data['remarks'] = $request->remarks;
            $followup_data['next_schedule'] = $request->next_schedule;
            if($data = $this->followup->create($followup_data)) {
                Toastr()->success('Followup Created Successfully','Success');
                return redirect()->back();

            } else {
                Toastr()->error('There was error while creating','Error');
                return redirect()->back();
            }

        } catch (Exception $e) {
            return false;
        }
    }

    public function sendSMS(Request $request) {
        try{
            $registration = $this->registration->where('id',$request->registration_id)->first();
            $campaign = $registration->campaign;
            $sms_message = $request->message;
            $url = setting('sms_api') ?? 'https://sms.aakashsms.com/sms/v3/send';
            $data = array(
                'auth_token' => setting('sms_token') ?? '28a22c64768a49ee5f539fa2924a8c278bb9ff16d7798496adbb87278d1c7e70',
                'from' => setting('sms_from') ?? '31001',
                'to' => $registration->phone,
                'text' => $sms_message
            );
            $response = smsPost($url, $data);

            Toastr()->success('SMS Send Successfully','Success');
            return redirect()->back();

        } catch (Exception $e) {
            return false;
        }
    }

    public function updateLeadCategory(Request $request) {
        try{
            $registration = $this->registration->where('id',$request->registration_id);
            if($registration->count() == 1) {
                $registration_data['leadcategory_id'] = $request->leadcategory_id;
                $registration->update($registration_data);
            }

            Toastr()->success('Lead Category Updated Successfully','Success');
            return redirect()->back();

        } catch (Exception $e) {
            return false;
        }
    }


    public function getRegistration(Request $request) {
        if($registration = $this->registration->where('id', $request->registration_id)->first())
        {
            return response()->json([
                'data' => $registration,
                'status' => true,
                'message' => "Commission Generated Successfully."
            ]);
        }

    }


}
