<?php

namespace App\Modules\Models\Commission;

use App\Modules\Models\Admission\Admission;
use App\Modules\Models\ClaimCommission\ClaimCommission;
use App\Modules\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $table = 'tbl_commissions';

    protected $fillable = [
        'student_id',
        'admission_id',
        'title',
        'fees',
        'claim_date',
        'created_by'
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function admission(){
        return $this->belongsTo(Admission::class,'admission_id','id');
    }

    public function claimCommission(){
        return $this->belongsTo(ClaimCommission::class,'commissions_id','commission_id')->latest();
    }
}
