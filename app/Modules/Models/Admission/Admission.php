<?php

namespace App\Modules\Models\Admission;

use App\Modules\Models\College\College;
use App\Modules\Models\Student\Student;
use App\Modules\Models\Commission\Commission;
use App\Modules\Models\Country\Country;
use App\Modules\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table = 'tbl_admissions';

    protected $fillable = [
        'student_id',
        'country_id',
        'state_id',
        'college_id',
        'fees',
        'intake_year',
        'intake_month',
        'commenced_date',
        'commenced_status',
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class,'college_id');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class,'admission_id','id')->orderBy('commissions_id');
    }

    public function claimCommission()
    {
        return $this->hasMany(Commission::class,'admission_id','id')->orderBy('claim_date')->where('commissions_status','pending');
    }


}
