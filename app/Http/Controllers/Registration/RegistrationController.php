<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Modules\Models\FollowUp\FollowUp;
use Illuminate\Http\Request;
use App\Modules\Models\Registration\Registration;
use App\Modules\Models\User;

class RegistrationController extends Controller
{
    protected $customer, $registration, $followup;

    function __construct(User $user, Registration $registration, FollowUp $followup)
    {
        $this->user = $user;
        $this->registration = $registration;
        $this->followup = $followup;

    }
    public function customerForm()
    {
        return view('frontend.customer.form');
    }

    public function index()
    {
        //
        $registrations = $this->registration->orderBy('created_at', 'desc')->get();
        return view('registration.index', compact('registrations'));
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

    public function addFollowUp(Request $request) {

        try{
            $followup = $this->followup->where('refrence_id',$request->refrence_id)->where('follow_up_type', $request->follow_up_type);
            if(isset($followup)) {
                $data['refrence_id'] = $request->refrence_id;
                $data['follow_up_name'] = $request->follow_up_name;
                $data['follow_up_type'] = $request->follow_up_type;
                $data['remarks'] = $request->remarks;
                $data['next_schedule'] = $request->next_schedule;
                $data['follow_up_by'] = $request->follow_up_by;
                $followup->update($data);
                Toastr()->success('Followup Created Successfully','Success');
                return redirect()->back();
            } else {
                if($followup = $this->followup->create($request->all())) {
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
