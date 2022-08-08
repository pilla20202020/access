<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Modules\Models\TestPreparation\TestPreparation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\DataTables\Facades\DataTables;


class TestPreparationController extends Controller
{

    protected $preparation;

    function __construct(TestPreparation $preparation)
    {
        $this->preparation = $preparation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('preparation.index');
    }

    public function getAllData()
    {
        $query = TestPreparation::all();
        return DataTables::of($query)

            ->addIndexColumn()
            ->editColumn('status', function ($query) {
                if ($query->status == 'Active') {
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">In-Active</span>';
                }
            })
            ->addColumn('actions', function ($query) {
                $editRoute =  route('preparation.edit', $query->id);
                $deleteRoute = route('preparation.destroy', $query->id);
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
        return view('preparation.create');
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
            'name' => 'required|max:255|unique:test_preparations,name',
            'description' => 'max:1024'
        ]);
        if (TestPreparation::create($request->all())) {
            return redirect()->route('preparation.index')->with('message', 'The Test Preparation Created Successfully!');
        }else{
            return redirect()->route('preparation.index')->with('error', 'Some Error Occured!');
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
        try{
            $preparation = $this->preparation->findOrFail($id);
            return view('preparation.edit',compact('preparation'));
        }catch(ModelNotFoundException $ex){
            return redirect()->route('preparation.index')->with('error', $ex->getMessage());
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
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:1024'
        ]);

        try{
            $preparation = $this->preparation->findOrFail($id);
            $preparation->update($request->all());
            return redirect()->route('preparation.index')->with('message', 'Test Preparation Updated Successfully!');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('preparation.index')->with('error', $ex->getMessage());
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
        $preparation = $this->preparation->find($id);
        if($preparation->delete()) {
            return response()->json(['status'=>true]);
        }
    }
}
