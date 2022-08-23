<?php

namespace App\Modules\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    use HasFactory;
    protected $table = 'tbl_student_education';

    protected $fillable = [
        'student_id',
        'level',
        'university',
        'percentage',
        'documents',
    ];

    public static function getStudents()
    {
        // $records = DB::table('candidates')->select('id','first_name','middle_name','last_name','gender','material_status','spouse_name','father_name','mother_name','mobile_no','alternate_mobile_no','email','dob','full_address','status','is_active')->get()->toArray();
        $records = DB::table('candidates')
                        ->join('candidate_passports','candidate_passports.candidate_id','candidates.id')
                        ->join('countries','countries.id','candidates.country_id')
                        ->join('provinces','provinces.id','candidates.province_id')
                        ->join('districts','districts.id','candidates.district_id')
                        ->join('districts AS cid','cid.id','candidate_passports.citizenship_issue_district')
                        ->select('candidates.id','candidates.first_name','candidates.middle_name','candidates.last_name','candidates.gender','candidates.spouse_name','candidates.father_name','candidates.mother_name','candidates.mobile_no','candidates.alternate_mobile_no','candidates.email','candidates.dob','countries.country_name','provinces.province_name','districts.district_name','candidates.municipality_name','candidates.ward_no','candidates.full_address','candidate_passports.passport_number','candidate_passports.passport_issue_date','candidate_passports.passport_expiry_date','candidate_passports.citizenship_number','candidate_passports.citizenship_issue_date','cid.district_name AS cid_name')
                        ->get()
                        ->toArray();
        return $records;
    }


}
