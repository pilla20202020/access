<?php

namespace App\Http\Controllers\FollowUp;

use App\Http\Controllers\Controller;
use App\Modules\Models\FollowUp\FollowUp;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    protected $followup;

    function __construct(FollowUp $followup)
    {
        $this->followup = $followup;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $followups = $this->followup->orderBy('created_at', 'desc')->get();
        return view('followup.index', compact('followups'));
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
        $followup = $this->followup::where('id', $id)->first();
        return view('followup.show', compact('followup'));

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
        $followup = $this->followup::where('id', $id)->first();
        $followup->delete();
        Toastr()->success('Followup Deleted Successfully','Success');
        return redirect()->route('followup.index');
    }
}
