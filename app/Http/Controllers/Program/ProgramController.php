<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Modules\Models\Criteria\Criteria;
use App\Modules\Models\Eligibility\Eligibility;
use App\Modules\Models\Fee\Fee;
use App\Modules\Models\Intake\Intake;
use App\Modules\Models\Program\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    protected $program;

    function __construct(Program $program)
    {
        $this->program = $program;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $programs = $this->program->get();
        return view('program.index',compact('programs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('program.create');
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
        try {
            $data = $request->all();

            $programdetail = DB::transaction(function () use ($data) {
                $programData = [
                    'title' => $data['title'],
                    'checklist_documents' => $data['checklist_documents'],
                    'image' => $data['image'],
                    'description' => $data['description'],
                    'contact_person' => $data['contact_person'],
                    'contact_email' => $data['contact_email'],
                    'contact_number' => $data['contact_number'],
                    'special_instruction' => $data['special_instruction'],
                    'created_by' => Auth::user()->id,

                ];
                $program = $this->program->create($programData);


                // Intake
                if (!empty($data['intake_title'])) {
                    foreach ($data['intake_title'] as $key => $value) {
                        $intake = [
                            'program_id' => $program->id,
                            'title' => $data['intake_title'][$key] ?? null,
                            'intake_date' => $data['intake_date'][$key] ?? null,
                            'class_commencement' => $data['class_commencement'][$key] ?? null,
                            'deadline_date' => $data['deadline_date'][$key] ?? null
                        ];
                        Intake::create($intake);
                    }
                }
                // Intake

                // Fee
                if (!empty($data['fee_title'])) {
                    foreach ($data['fee_title'] as  $key => $value) {
                        $fee_detail = [
                            'program_id' => $program->id,
                            'title' => $data['fee_title'][$key] ?? null,
                            'type' => $data['fee_type'][$key] ?? null,
                            'amount' => $data['fee_amount'][$key] ?? null
                        ];
                        // dd($quali);
                        Fee::create($fee_detail);
                    }
                }
                // Fee

                // Eligibility
                if (!empty($data['eligibility_stream'])) {
                    foreach ($data['eligibility_stream'] as  $key => $value) {
                        $field = [
                            'program_id' => $program->id,
                            'stream' => $data['eligibility_stream'][$key] ?? null,
                            'level' => $data['eligibility_level'][$key] ?? null,
                            'grade' => $data['eligibility_grade'][$key] ?? null,
                        ];
                        // dd($quali);
                        Eligibility::create($field);
                    }
                }
                // Eligibility


                // Criteria
                if (!empty($data['criteria_title'])) {
                    foreach ($data['criteria_title'] as  $key => $value) {
                        $criteria_data = [
                            'program_id' => $program->id,
                            'title' => $data['criteria_title'][$key] ?? null,
                            'min' => $data['criteria_min'][$key] ?? null,
                            'max' => $data['criteria_max'][$key] ?? null,
                            'date' => $data['criteria_date'][$key] ?? null,
                        ];
                        // dd($quali);
                        Criteria::create($criteria_data);
                    }
                }
                // Eligibility


            });
            Toastr()->success('Programs Created Successfully','Success');
            return redirect()->route('program.index');

        } catch (Exception $e) {
            return null;
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
        $program = $this->program->where('id',$id)->first();
        return view('program.edit',compact('program'));

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
