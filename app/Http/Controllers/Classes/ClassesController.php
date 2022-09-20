<?php

namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classes\ClassesRequest;
use App\Modules\Models\Classes\Classes;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    protected $class;

    function __construct(Classes $class)
    {
        $this->class = $class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = $this->class->paginate();
        return view('class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('class.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassesRequest $request)
    {
        //
        $class = $this->class->create($request->all());
        Toastr()->success('Class Created Successfully','Success');
        return redirect()->route('classes.index');
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
        $class = $this->class->where('id',$id)->first();
        return view('class.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassesRequest $request, $id)
    {
        //
        $class = $this->class->where('id',$id);
        if($class->update($request->data())) {
            Toastr()->success('Class Updated Successfully','Success');
            return redirect()->route('classes.index');
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
        $class = $this->class->where('id',$id);
        $class->delete();
        Toastr()->success('Class Deleted Successfully','Success');
        return redirect()->route('classes.index');
    }
}
