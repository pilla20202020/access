<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Modules\Models\Location\Location;
use App\Modules\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LocationController extends Controller
{
    protected $location, $user;

    function __construct(Location $location, User $user)
    {
        $this->location = $location;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('location.index');

    }

    public function getAllData()
    {
        $query = Location::all();
        return DataTables::of($query)

            ->addIndexColumn()
            ->addColumn('actions', function ($query) {
                $editRoute =  route('location.edit', $query->id);
                $deleteRoute = route('location.destroy', $query->id);
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
        return view('location.create');

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
            'name' => 'required|max:255|unique:tbl_locations,name',
            'email' => 'required',
            'password' => 'required'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        $data['password'] = Hash::make($request->password);
        $data['status'] = "Active";
        $user = $this->user::create($data);
        $user->assignRole('Consultancy');
        $location['name'] = $request->name;
        $location['email'] = $request->email;
        $location['user_id'] = $user->id;
        $location['description'] = $request->description;
        if ($location = $this->location::create($location)) {
            $location->fill([
                'slug' => Str::slug($request->name),
            ])->save();
            return redirect()->route('location.index')->with('message', 'The Location Created Successfully!');
        }else{
            return redirect()->route('location.index')->with('error', 'Some Error Occured!');
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
            $location = $this->location->findOrFail($id);
            return view('location.edit',compact('location'));
        }catch(ModelNotFoundException $ex){
            return redirect()->route('location.index')->with('error', $ex->getMessage());
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
            'email' => 'required'
        ]);

        try{
            $location = $this->location->findOrFail($id);
            $location->update($request->all());
            $location->fill([
                'slug' => Str::slug($request->name),
                'user_id' => $location->user_id,
            ])->save();
            return redirect()->route('location.index')->with('message', 'Location Updated Successfully!');
        }catch(ModelNotFoundException $ex){
            return redirect()->route('location.index')->with('error', $ex->getMessage());
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
        $location = $this->location->find($id);
        if($location->delete()) {
            return response()->json(['status'=>true]);
        }
    }
}
