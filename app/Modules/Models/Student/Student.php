<?php

namespace App\Modules\Models\Student;

use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Agent\Agent;
use App\Modules\Models\Country\Country;
use App\Modules\Models\District\District;
use App\Modules\Models\Location\Location;
use App\Modules\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = 'tbl_students';

    use HasFactory;

    protected $fillable = [
        'applicant',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'material_status',
        'spouse_name',
        'father_name',
        'mother_name',
        'mobile_no',
        'alternate_mobile_no',
        'email',
        'dob',
        'country_id',
        'state_id',
        'source_ref',
        'ref_id',
        'district_id',
        'municipality_name',
        'ward_no',
        'intake_year',
        'intake_month',
        'village_name',
        'full_address',
        'preffered_location',
        'intrested_for_country',
        'intrested_course',
        'status',
        'created_by',
        'updated_by',
    ];

    public function admission(){
        return $this->belongsTo(Admission::class,'id','student_id');
    }

    public function educations()
    {
        return $this->hasMany(StudentEducation::class,'student_id','id');
    }

    public function languages()
    {
        return $this->hasMany(StudentLanguage::class,'student_id','id');
    }

    public function fields()
    {
        return $this->hasMany(StudentField::class,'student_id','id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class,'ref_id','id');
    }

    public function location(){
        return $this->belongsTo(Location::class,'ref_id','id');
    }

    public function student_country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function student_state(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function student_district(){
        return $this->belongsTo(District::class,'district_id','id');
    }

}
