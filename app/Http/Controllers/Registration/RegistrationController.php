<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Models\Registration\Registration;
use App\Modules\Models\User;

class RegistrationController extends Controller
{
    protected $customer, $registration;

    function __construct(User $user, Registration $registration)
    {
        $this->user = $user;
        $this->registration = $registration;

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


}
