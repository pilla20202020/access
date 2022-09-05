<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Modules\Models\Agent\Agent;
use App\Modules\Models\Branch\Branch;
use App\Modules\Models\Country\Country;
use App\Modules\Models\Location\Location;
use App\Modules\Models\Student\Student;
use App\Modules\Models\Student\StudentEducation;
use App\Modules\Models\Student\StudentField;
use App\Modules\Models\Student\StudentLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $students, $country, $agent, $location;

    function __construct(Student $students,Country $country, Agent $agent, Location $location)
    {
        $this->students = $students;
        $this->country = $country;
        $this->agent = $agent;
        $this->location = $location;
    }

    public function index()
    {
        //
        $students = $this->students->paginate();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = $this->country->where('status','Active')->get();
        $agents = $this->agent->get();
        $locations = $this->location->get();
        return view('student.create',compact('countries','agents','locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        //
        try {
            $data = $request->all();
            $student = DB::transaction(function () use ($data) {
                $studentData = [
                    'applicant' => $data['applicant'],
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name' => $data['last_name'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'material_status' => $data['material_status'] ?? null,
                    'father_name' => $data['father_name'],
                    'mother_name' => $data['mother_name'],
                    'spouse_name' => $data['material_status'] == 'Yes' ? $data['spouse_name']:null,
                    'mobile_no' => $data['mobile_no'],
                    'alternate_mobile_no' => $data['alternate_mobile_no'],
                    'email' => $data['email'],
                    'country_id' => $data['country_id'] ?? null,
                    'state_id' => $data['state_id'] ?? null,
                    'district_id' => $data['district_id'] ?? null,
                    'municipality_name' => $data['municipality_name'],
                    'ward_no' => $data['ward_no'],
                    'village_name' => $data['village_name'],
                    'full_address' => $data['full_address'],
                    'intake_month' => $data['intake_month'],
                    'intake_year' => $data['intake_year'],
                    'source_ref' => $data['source_ref'] ?? null,
                    'ref_id' => $data['ref_id'] ?? null,
                    'created_by' => Auth::user()->id,

                ];
                $student = $this->students->create($studentData);


                // Student Education
                $documentsPath = [];
                if (!empty($data['documents'])) {
                    foreach ($data['documents'] as $value) {
                        $documentsPath[] = uploadCommonFile($value, 'qualification/');
                    }
                }

                if (!empty($data['level'])) {
                    foreach ($data['level'] as $key => $value) {
                        $quali = [
                            'student_id' => $student->id,
                            'level' => $data['level'][$key],
                            'university' => $data['university'][$key],
                            'percentage' => $data['percentage'][$key],
                            'documents' => $documentsPath[$key] ?? null
                        ];
                        // dd($quali);
                        StudentEducation::create($quali);
                    }
                }
                // Student Education

                // Student Language
                $languageDocumentsPath = [];
                if (!empty($data['language_documents'])) {
                    foreach ($data['language_documents'] as $value) {
                        $languageDocumentsPath[] = uploadCommonFile($value, 'language/');
                    }
                }
                if (!empty($data['language'])) {
                    foreach ($data['language'] as  $key => $value) {
                        $lang = [
                            'student_id' => $student->id,
                            'language' => $data['language'][$key],
                            'score' => $data['score'][$key],
                            'language_documents' => $languageDocumentsPath[$key] ?? null
                        ];
                        // dd($quali);
                        StudentLanguage::create($lang);
                    }
                }

                if (!empty($data['preferred_field'])) {
                    foreach ($data['preferred_field'] as  $key => $value) {
                        $field = [
                            'student_id' => $student->id,
                            'name' => $data['preferred_field'][$key],
                        ];
                        // dd($quali);
                        StudentField::create($field);
                    }
                }
                // Student Language

            });
            Toastr()->success('Student Created Successfully','Success');
            return redirect()->route('student.index');

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
    public function edit($student)
    {
        //
        $student = $this->students->where('id',$student)->first();
        $agents = $this->agent->get();
        $countries = $this->country->where('status','Active')->get();
        $states = getStatesByCountryId($student->country_id);
        $districts = getDistrictsByProvinceId($student->state_id);
        $issue_districts = getDistricts();
        $locations = $this->location->get();
        $fields = StudentField::where('student_id',$student->id)->pluck('name')->toArray();
        return view('student.edit', compact('student','countries','locations','agents','fields','states','districts','issue_districts'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentId)
    {
        //
        try {
            $data = $request->all();

            $student = DB::transaction(function () use ($data, $studentId) {
                $student = $this->students->where('id',$studentId);

                $studentData = [
                    'applicant' => $data['applicant'],
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name' => $data['last_name'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'material_status' => $data['material_status'] ?? null,
                    'father_name' => $data['father_name'],
                    'mother_name' => $data['mother_name'],
                    'spouse_name' => $data['material_status'] == 'Yes' ? $data['spouse_name']:null,
                    'mobile_no' => $data['mobile_no'],
                    'alternate_mobile_no' => $data['alternate_mobile_no'],
                    'email' => $data['email'],
                    'country_id' => $data['country_id'] ?? null,
                    'state_id' => $data['state_id'] ?? null,
                    'district_id' => $data['district_id'] ?? null,
                    'municipality_name' => $data['municipality_name'],
                    'ward_no' => $data['ward_no'],
                    'village_name' => $data['village_name'],
                    'full_address' => $data['full_address'],
                    'intake_month' => $data['intake_month'],
                    'intake_year' => $data['intake_year'],
                    'source_ref' => $data['source_ref'] ?? null,
                    'ref_id' => $data['ref_id'] ?? null,
                    'created_by' => Auth::user()->id,
                ];
                $student->update($studentData);
                $student = $student->first();
                // $levels = StudentEducation::where('student_id', $student->id)->get();
                // foreach ($levels as $level) {
                //     // $imageFile = public_path().'/storage/'.$level->documents;
                //     // unlink($imageFile);
                //     $level->delete();
                // }
                $documentsPath = [];
                if (!empty($data['documents'])) {
                    foreach ($data['documents'] as $key => $value) {
                        if(!empty($data['qualification_id'][$key])){
                            $existingQuli = StudentEducation::find($data['qualification_id'][$key]);
                            if($existingQuli){
                                $documentsPath[$key] = uploadCommonFile($value, 'qualification/',$existingQuli->documents);
                            }

                        }else{
                            $documentsPath[$key] = uploadCommonFile($value, 'qualification/');
                        }

                    }
                }
                if (!empty($data['level'])) {
                    foreach ($data['level'] as $key => $value) {
                        $quali = [
                            'student_id' => $student->id,
                            'level' => $data['level'][$key],
                            'university' => $data['university'][$key],
                            'percentage' => $data['percentage'][$key],

                        ];
                        if(isset($documentsPath[$key])){
                            $quali['documents'] = $documentsPath[$key];
                        }
                        if(!empty($data['qualification_id'][$key])){
                            $existingQuli = StudentEducation::find($data['qualification_id'][$key]);
                            if($existingQuli){
                                $existingQuli->update($quali);
                            }
                        }else{
                            StudentEducation::create($quali);
                        }
                    }
                }
                // Student Education

                // Student Language
                $languageDocumentsPath = [];
                if (!empty($data['language_documents'])) {
                    foreach ($data['language_documents'] as $key => $value) {
                        if(!empty($data['language_id'][$key])){
                            $existingLang = StudentLanguage::find($data['language_id'][$key]);
                            if($existingQuli){
                                $languageDocumentsPath[$key] = uploadCommonFile($value, 'language/',$existingLang->documents);
                            }

                        }else{
                            $languageDocumentsPath[$key] = uploadCommonFile($value, 'language/');
                        }

                    }
                }
                if (!empty($data['language'])) {
                    foreach ($data['language'] as  $key => $value) {
                        $lang = [
                            'student_id' => $student->id,
                            'language' => $data['language'][$key],
                            'score' => $data['score'][$key],
                        ];
                        if(isset($languageDocumentsPath[$key])){
                            $lang['language_documents'] = $languageDocumentsPath[$key];
                        }

                        if(!empty($data['language_id'][$key])){
                            $existingLang = StudentLanguage::find($data['language_id'][$key]);
                            if($existingLang){
                                $existingLang->update($lang);
                            }
                        }else{
                            StudentLanguage::create($lang);
                        }
                        // dd($quali);
                    }
                }
                $studentField = StudentField::where('student_id',$student->id)->get();
                foreach ($studentField as $field) {
                    $field->delete();
                }

                if (!empty($data['preferred_field'])) {
                    foreach ($data['preferred_field'] as  $key => $value) {
                        $field = [
                            'student_id' => $student->id,
                            'name' => $data['preferred_field'][$key],
                        ];
                        // dd($quali);
                        StudentField::create($field);
                    }
                }
                // Student Language

            });
            Toastr()->success('Student Created Successfully','Success');
            return redirect()->route('student.index');

        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student)
    {
        //
        $student = $this->students->where('id',$student);
        $student->delete();
        return redirect()->route('student.index')->withSuccess(trans('Student has been deleted'));
    }

    public function deleteAcademic($id) {
        $academic = StudentEducation::find($id);
        $academic->delete();
        Toastr()->success('Education Deleted Successfully','Success');
        return redirect()->back();
    }

    public function deleteTest($id) {
        $language = StudentLanguage::find($id);
        $language->delete();
        Toastr()->success('Language Deleted Successfully','Success');
        return redirect()->back();
    }
}
