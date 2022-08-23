<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admission\AdmissionRequest;
use App\Jobs\SendMailToAgentBranchJob;
use App\Jobs\SendMailToStudentJob;
use App\Mail\AgentForwardMail;
use App\Mail\StudentForwardMail;
use App\Modules\Models\Admission\Admission;
use App\Modules\Models\ClaimCommission\ClaimCommission;
use App\Modules\Models\College\College;
use App\Modules\Models\Commission\Commission;
use App\Modules\Models\Country\Country;
use App\Modules\Models\FollowUp\FollowUp;
use App\Modules\Models\State\State;
use App\Modules\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $admission, $students, $commission, $claimCommission, $followup, $country;

    function __construct(Admission $admission, Student $students, Commission $commission, ClaimCommission $claimCommission, FollowUp $followup, Country $country)
    {
        $this->admission = $admission;
        $this->students = $students;
        $this->commission = $commission;
        $this->claimCommission = $claimCommission;
        $this->followup = $followup;
        $this->country = $country;
    }

    public function index()
    {
        //
        $admissions = $this->admission->paginate();
        return view('admission.index', compact('admissions'));
    }

    public function getCommencedAdmission()
    {
        $admissions = $this->admission->whereNotNull('commenced_date')->where('commenced_status','applied')->paginate();
        return view('commenced_admission.index', compact('admissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $students =$this->students->paginate();
        $countries = $this->country->where('status','Active')->get();
        return view('admission.create',compact('students','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdmissionRequest $request)
    {
        //
        try {
            $admission = $this->verifyAdmissionofStudent($request);
            if($admission == true){
                $admission = $this->admission->create($request->data());
                Toastr()->success('Admission Created Successfully','Success');
                return redirect()->route('admission.index');
            } else {
                return redirect()->back();
            }

        } catch (Exception $e) {
            return false;
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
    public function edit($admission)
    {
        //
        $admission = $this->admission->where('id',$admission)->first();
        $students =$this->students->paginate();
        $countries = $this->country->where('status','Active')->get();
        $states = State::where('status','Active')->get();
        $colleges = College::where('status','Active')->get();
        return view('admission.edit', compact('admission','students','countries','states','colleges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdmissionRequest $request, $admission)
    {
        //
        try {
            $admission = $this->admission->where('id',$admission);
            if($admission->update($request->data())) {
                Toastr()->success('Admission Updated Successfully','Success');
                return redirect()->route('admission.index');
            } else {
                Toastr()->error('There was error while updating.','Sorry');
                return redirect()->route('admission.index');
            }
        } catch (Exception $e) {
            return false;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($admission)
    {
        //
        $admission = $this->admission->where('id',$admission);
        $admission->delete();
        return redirect()->route('admission.index')->withSuccess(trans('Admission has been deleted'));
    }

    public function addCommencement(Request $request) {
        try{
            $admission = $this->admission->where('student_id',$request->student_id)->whereNotNull('commenced_date')->where('commenced_status','applied')->get();
            if(!$admission->isEmpty()) {
                Toastr()->error('The requested student has already commenced to another college','Error');
                return redirect()->back();
            } else {
                $student = $this->students->where('id',$request->student_id)->first();
                // Mail::to($student->agent->email)->send(new AgentForwardMail());
                $admission = $this->admission->where('id',$request->admission_id);
                $college = $admission->first()->college;
                $data['commenced_date'] = $request->commenced_date;
                $data['commenced_status'] = "applied";
                // Mail::to('ritu.gubhaju20@gmail.com')->send(new StudentForwardMail($student, $admission->first(), $college));
                if($student->source_ref == "branch" && isset($student->location)) {
                    $agent_branch = $student->location;
                    SendMailToAgentBranchJob::dispatch($agent_branch, $admission->first(), $college, $student)
                    ->delay(now()->addSeconds(10));
                }
                if($student->source_ref == "agent" && isset($student->agent)) {
                    $agent_branch = $student->agent;
                    SendMailToAgentBranchJob::dispatch($agent_branch, $admission->first(), $college, $student)
                    ->delay(now()->addSeconds(10));
                }
                SendMailToStudentJob::dispatch($student, $admission->first(), $college)
                ->delay(now()->addSeconds(10));
                if($admission->update($data)) {
                    Toastr()->success('Commenced Added Successfully','Success');
                    return redirect()->back();
                } else {
                    Toastr()->success('There was error while adding commencement','Error');
                    return redirect()->back();
                }
            }

        } catch (Exception $e) {
            return false;
        }
    }

    public function verifyAdmissionofStudent($request){
        $student_id = $request->student_id;
        $admission = $this->admission->where('student_id',$student_id)->whereNotNull('commenced_date')->where('commenced_status','applied')->get();
        if(!$admission->isEmpty()) {
            Toastr()->error('The student has already admitted to the college.','Sorry');
            return false;
        } else {
            $admission = $this->admission->where('student_id',$student_id)->where('college_id',$request->college_id)->get();
            if(!$admission->isEmpty()) {
                Toastr()->error('The student has already applied for this college.','Sorry');
                return false;
            }

        }
        return true;
    }

    public function commissionRate($admission) {
        $admission = $this->admission->where('id',$admission)->first();
        return view('admission.commission', compact('admission'));

    }

    public function storeCommissionRate(Request $request) {
        try{
            $commissions = $this->commission->where('admission_id', $request->admission_id);
            $commissions->delete();
            $p = 0;

            foreach($request->title as $content) {
                $commissions = new Commission();
                $commissions['admission_id'] = $request->admission_id;
                $commissions['student_id'] = $request->student_id;
                $commissions['commissions_status'] = (isset($request->commissions_status[$p]) ?  $request->commissions_status[$p] : 'pending');
                $commissions['title'] = $content;
                $commissions['fees'] = $request->fees[$p];
                $commissions['claim_date'] = $request->claim_date[$p];
                $commissions['created_by'] = Auth::user()->users_id;
                $commissions->save();
                $p = $p + 1;
            }
            Toastr()->success('Commission Updated Successfully','Success');
            return redirect()->route('admission.getcommencedadmission');
        } catch(Exception $e) {
            return null;
        }
    }

    public function deleteCommission($id) {

        try {
            $commission = $this->commission->where('commissions_id',$id);
            if($commission = $commission->delete()) {
                Toastr()->success('Commission has been deleted successfully','Success');
                return redirect()->back();
            } else {
                Toastr()->success('Commission cannot be deleted at the moment','Error');
                return redirect()->back();
            }

        } catch (Exception $e) {
            return false;
        }

    }

    // Get Commission Detail
    public function getCommissionDetail(Request $request) {
        if($data = $this->commission->where('admission_id', $request->admission_id)->get())
        {
            return response()->json([
                'data' => $data,
                'status' => true,
                'message' => "Commission Generated Successfully."
            ]);
        }
    }

    public function addCommissionClaim(Request $request) {

        try{
            if(isset($request->defer_date) && $request->commissions_claim_status == "defer") {
                $data['claim_date'] = $request->defer_date;
                $data['commissions_status'] = "pending";
                $commission = $this->commission->where('commissions_id',$request->commission_id);
                $commission->update($data);
            }
            elseif($request->commissions_claim_status == "paid") {
                $data['commissions_status'] = $request->commissions_claim_status;
                $commission = $this->commission->where('commissions_id',$request->commission_id);
                $commission->update($data);
            }
            if($claimCommission = $this->claimCommission->create($request->all())) {
                Toastr()->success('Commission Created Successfully','Success');
                return redirect()->back();

            } else {
                Toastr()->error('There was error while creating','Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            return false;
        }
    }


    public function addFollowUp(Request $request) {
        try{
            if($followup = $this->followup->create($request->all())) {
                Toastr()->success('Followup Created Successfully','Success');
                return redirect()->back();

            } else {
                Toastr()->error('There was error while creating','Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function generateInvoice($id) {
        $admission = $this->admission->where('id',$id)->first();
        return view('commenced_admission.invoice', compact('admission'));
    }
}
