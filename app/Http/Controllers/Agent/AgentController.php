<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\AgentRequest;
use App\Modules\Models\Agent\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    protected $agent;

    function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $agents = $this->agent->paginate();
        return view('agent.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('agent.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgentRequest $request)
    {
        //
        $agent = $this->agent->create($request->data());
        Toastr()->success('Agent Created Successfully','Success');
        return redirect()->route('agent.index');
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
        $agent = $this->agent->where('id',$id)->first();
        return view('agent.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgentRequest $request, $id)
    {
        //
        $agent = $this->agent->where('id',$id);
        if($agent->update($request->data())) {
            Toastr()->success('Agent Updated Successfully','Success');
            return redirect()->route('agent.index');
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
        $agent = $this->agent->where('id',$id);
        $agent->delete();
        Toastr()->success('Agent Deleted Successfully','Success');
        return redirect()->route('agent.index');
    }
}
