<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Models\Campaign\Campaign;
use App\Modules\Models\FollowUp\FollowUp;
use App\Modules\Models\Registration\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $followups, $registration, $campaign;

    function __construct(FollowUp $followup, Registration $registration, Campaign $campaign)  {
        $this->followup = $followup;
        $this->registration = $registration;
        $this->campaign = $campaign;

    }

    public function index()
    {
        $followups = $this->followup->where('next_schedule', '>', date('Y-m-d'))->orderBy('next_schedule', 'ASC')->get();
        $registrations = $this->registration->orderBy('created_at', 'desc')->get();
        $campaigns = $this->campaign->orderBy('created_at', 'desc')->get();
        return view('dashboard.index',compact('followups','registrations','campaigns'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
