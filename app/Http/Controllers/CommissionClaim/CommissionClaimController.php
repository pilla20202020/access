<?php

namespace App\Http\Controllers\CommissionClaim;

use App\Http\Controllers\Controller;
use App\Modules\Models\Admission\Admission;
use App\Modules\Models\ClaimCommission\ClaimCommission;
use App\Modules\Models\College\College;
use App\Modules\Models\Commission\Commission;
use App\Modules\Models\Country\Country;
use App\Modules\Models\State\State;
use App\Modules\Models\Student\Student;
use Illuminate\Http\Request;

class CommissionClaimController extends Controller
{

    protected $admission, $students, $commission, $claimCommission, $country, $state, $college;

    function __construct(Admission $admission, Student $students, Commission $commission, ClaimCommission $claimCommission, Country $country, State $state, College $college)
    {
        $this->admission = $admission;
        $this->students = $students;
        $this->commission = $commission;
        $this->claimCommission = $claimCommission;
        $this->country = $country;
        $this->state = $state;
        $this->college = $college;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $commissions = $this->commission->where('commissions_status','!=','paid')->paginate();
        $countries = $this->country->where('status','Active')->get();
        return view('claimcommission.index', compact('commissions','countries'));
    }

    public function getCommissionByParameter(Request $request) {
        $filters = [
            'country_id'    => $request->country_id,
            'state_id'    => $request->state_id,
            'college_id'    => $request->college_id,
        ];
        $commissions = $this->commission->where('commissions_status','!=','paid')->paginate();
        $countries = $this->country->where('status','Active')->get();
        $states = $this->state->where('status','Active')->get();
        $colleges = $this->college->where('status','Active')->get();
        return view('claimcommission.getCommissionByParameter', compact('commissions','countries','filters','states','colleges'));

    }

    public function claimed()
    {
        $commissions = $this->commission->where('commissions_status','paid')->paginate();
        $countries = $this->country->where('status','Active')->get();
        return view('claimcommission.claimed.index', compact('commissions','countries'));
    }

    public function getClaimedCommissionByParameter(Request $request)
    {
        $filters = [
            'country_id'    => $request->country_id,
            'state_id'    => $request->state_id,
            'college_id'    => $request->college_id,
        ];
        $commissions = $this->commission->where('commissions_status','paid')->paginate();
        $countries = $this->country->where('status','Active')->get();
        $states = $this->state->where('status','Active')->get();
        $colleges = $this->college->where('status','Active')->get();
        return view('claimcommission.claimed.getClaimedListByParameter', compact('commissions','countries','filters','states','colleges'));

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
