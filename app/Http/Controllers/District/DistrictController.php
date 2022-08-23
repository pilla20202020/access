<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Models\Country\Country;
use App\Modules\Models\Province\Province;
use App\Modules\Models\District\District;
use App\Modules\Models\State\State;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('config.district.index');
    }

    public function getAllData()
    {
        $query = District::get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('state', function($query){
                return $query->state->state_name;
            })
            ->addColumn('country', function($query){
                return $query->state->country->country_name;
            })
            ->addColumn('status',function($query){
                if($query->status == 'Active'){
                    return '<input type="checkbox" name="status" class="status_switch" id="switch'.$query->id.'" data-id="'.$query->id.'" switch="none" checked/><label for="switch'.$query->id.'" data-on-label="On" data-off-label="Off"></label>';
                } else {
                    return '<input type="checkbox" name="status" class="status_switch" id="switch'.$query->id.'" data-id="'.$query->id.'" switch="none"/><label for="switch'.$query->id.'" data-on-label="On" data-off-label="Off"></label>';

                }
            })
            ->addColumn('actions', function ($query) {
                    $editRoute =  route('districts.edit', $query->id);
                    return getTableHtml($query, 'actions', $editRoute);
            })->rawColumns(['status'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::where('status','Active')->get();
        return view('config.district.create',compact('countries'));
    }

    public function getState(Request $request)
    {
        $country_id = $request->country_id;
        $provinces = State::where('country_id',$country_id)->where('status','Active')->get();
        return response()->json(['status'=>200, 'message'=>$provinces]);
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
        $input = $request->all();
        District::create($input);
        Toastr()->success('Data has been added successfully!','Success');
        return redirect()->route('districts.index');
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
