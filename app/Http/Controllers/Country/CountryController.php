<?php

namespace App\Http\Controllers\Country;

use App\Modules\Models\Country\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index()
    {
        return view('config.country.index');
    }

    public function getAllData()
    {
        $query = Country::all();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status',function($query){
                if($query->status == 'Active'){
                    return '<input type="checkbox" name="status" class="status_switch" id="switch'.$query->id.'" data-id="'.$query->id.'" switch="none" checked /><label for="switch'.$query->id.'" data-on-label="On" data-off-label="Off"></label>';
                } else {
                    return '<input type="checkbox" name="status" class="status_switch" id="switch'.$query->id.'" data-id="'.$query->id.'" switch="none"/><label for="switch'.$query->id.'" data-on-label="On" data-off-label="Off"></label>';

                }
            })->rawColumns(['status'])->make(true);
    }

    public function changeStatus(Request $request)
    {
        $country = Country::findOrFail($request->country_id);
        $country->status = $request->status;
        if($country->status == 1)
        {
            $country->status = "Active";
            $country->save();
        } else {
            $country->status = 'Inactive';
            $country->save();
        }

        return response()->json(['status'=> true]);
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
