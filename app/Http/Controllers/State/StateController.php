<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller;
use App\Modules\Models\Country\Country;
use App\Modules\Models\State\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.state.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('status','Active')->get();
        return view('config.state.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        State::create($input);
        Toastr()->success('A new state has been added successfully!','Success');
        return redirect()->route('states.index');
    }

    public function getAllData()
    {
        $query = State::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('country',function($query){
                return $query->country->country_name;
            })
            ->addColumn('status',function($query){
                if($query->status == 'Active'){
                    return '<input type="checkbox" name="status" class="status_switch" id="switch'.$query->id.'" data-id="'.$query->id.'" switch="none" checked/><label for="switch'.$query->id.'" data-on-label="On" data-off-label="Off"></label>';
                } else {
                    return '<input type="checkbox" name="status" class="status_switch" id="switch'.$query->id.'" data-id="'.$query->id.'" switch="none"/><label for="switch'.$query->id.'" data-on-label="On" data-off-label="Off"></label>';

                }
            })
            ->addColumn('actions', function ($query) {
                    $editRoute =  route('states.edit', $query->id);
                    return getTableHtml($query, 'actions', $editRoute);
            })->rawColumns(['status'])->make(true);
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
        $state = State::findOrFail($id);
        $countries = Country::where('status','Active')->get();
        return view('config.state.edit',compact('state','countries'));
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
        $state = State::findOrFail($id);
        $state->state_name = $request->state_name;
        $state->country_id = $request->country_id;
        $state->status = $request->status;
        $state->save();
        Toastr()->success('Data has been updated successfully!','Success');
        return redirect()->route('states.index');

    }

    public function changeStatus(Request $request)
    {
        $state = State::findOrFail($request->state_id);
        $state->status = $request->status;
        if($state->status == 1)
        {
            $state->status = "Active";
            $state->save();
        } else {
            $state->status = 'Inactive';
            $state->save();
        }

        return response()->json(['status'=> true]);
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
