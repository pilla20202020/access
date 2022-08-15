<?php

namespace App\Http\Controllers\LeadCategory;

use App\Http\Controllers\Controller;
use App\Modules\Models\LeadCategory\LeadCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class LeadCategoryController extends Controller
{

    protected $leadcategory;

    function __construct(LeadCategory $leadcategory)
    {
        $this->leadcategory = $leadcategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('leadcategory.index');

    }

    public function getAllData()
    {
        $query = LeadCategory::all();
        return DataTables::of($query)

            ->addIndexColumn()
            ->addColumn('actions', function ($query) {
                $editRoute =  route('leadcategory.edit', $query->id);
                $deleteRoute = route('leadcategory.destroy', $query->id);
                return getTableHtml($query, 'actions', $editRoute, $deleteRoute);
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
        return view('leadcategory.create');

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
        $request->validate([
            'name' => 'required|max:255|unique:tbl_lead_categories,name',
            'color_code' => 'required'
        ]);
        if (LeadCategory::create($request->all())) {
            return redirect()->route('leadcategory.index')->with('message', 'The Lead Category Created Successfully!');
        }else{
            return redirect()->route('leadcategory.index')->with('error', 'Some Error Occured!');
        }
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
        try{
            $leadcategory = $this->leadcategory->findOrFail($id);
            return view('leadcategory.edit',compact('leadcategory'));
        }catch(ModelNotFoundException $ex){
            return redirect()->route('leadcategory.index')->with('error', $ex->getMessage());
        }
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
        $request->validate([
            'name' => 'required|max:255|',
            'color_code' => 'required'
        ]);

        try{
            $leadcategory = $this->leadcategory->findOrFail($id);
            $leadcategory->update($request->all());
            return redirect()->route('leadcategory.index')->with('message', 'Lead Category Updated Successfully!');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('leadcategory.index')->with('error', $ex->getMessage());
        }
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
        $leadcategory = $this->leadcategory->find($id);
        if($leadcategory->delete()) {
            return response()->json(['status'=>true]);
        }
    }
}
