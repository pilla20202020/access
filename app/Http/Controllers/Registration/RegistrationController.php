<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Modules\Models\FollowUp\FollowUp;
use App\Modules\Models\LeadCategory\LeadCategory;
use Illuminate\Http\Request;
use App\Modules\Models\Registration\Registration;
use App\Modules\Models\User;

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
        $registrations = $this->registration->orderBy('created_at', 'desc')->get();
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

    public function destroy($id)
    {
        $registration = Registration::where('id', $id)->first();
        $registration->delete();
        Toastr()->success('Registration Deleted Successfully','Success');
        return redirect()->route('registration.index');
    }

    // Get FollowUp
    public function viewFollowUp(Request $request) {
        if($followup = $this->followup->where('refrence_id', $request->registration_id)->where('follow_up_type','registration')->with('leadcategory')->latest()->get())
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
            $followup = $this->followup->where('refrence_id',$request->refrence_id)->where('follow_up_type', $request->follow_up_type);
            if($followup->count() == 1) {
                $data['refrence_id'] = $request->refrence_id;
                $data['follow_up_name'] = $request->follow_up_name;
                $data['follow_up_type'] = $request->follow_up_type;
                $data['remarks'] = $request->remarks;
                $data['next_schedule'] = $request->next_schedule;
                $data['follow_up_by'] = $request->follow_up_by;
                $data['leadcategory_id'] = $request->leadcategory_id;
                $followup->update($data);
                Toastr()->success('Followup Created Successfully','Success');
                return redirect()->back();
            } else {
                if($data = $this->followup->create($request->all())) {
                    Toastr()->success('Followup Created Successfully','Success');
                    return redirect()->back();

                } else {
                    Toastr()->error('There was error while creating','Error');
                    return redirect()->back();
                }
            }
        } catch (Exception $e) {
            return false;
        }
    }


}
