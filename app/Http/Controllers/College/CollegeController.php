<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Modules\Models\Country\Country;
use App\Modules\Models\State\State;
use App\Modules\Models\College\College;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.college.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('status','Active')->get();
        return view('config.college.create',compact('countries'));
    }

    public function getStates(Request $request)
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
        $input = $request->all();
        College::create($input);
        Toastr()->success('Data has been added successfully!','Success');
        return redirect()->route('colleges.index');
    }

    public function getAllData()
    {
        $query = College::get();
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
                    $editRoute =  route('colleges.edit', $query->id);
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
        $college = College::findOrFail($id);
        $state = State::where('id',$college->state_id)->first();
        $countries = Country::where('status','Active')->get();
        return view('config.college.edit',compact('college','countries','state'));
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
        $college = College::findOrFail($id);
        $college->name = $request->name;
        $college->country_id = $request->country_id;
        $college->state_id = $request->state_id;
        $college->status = $request->status;
        $college->save();
        Toastr()->success('Data has been updated successfully!','Success');
        return redirect()->route('colleges.index');

    }

    public function changeStatus(Request $request)
    {
        $college = College::findOrFail($request->college_id);
        $college->status = $request->status;
        if($college->status == 1)
        {
            $college->status = "Active";
            $college->save();
        } else {
            $college->status = 'Inactive';
            $college->save();
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
