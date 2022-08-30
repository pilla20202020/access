<?php

namespace App\Modules\Models\Program;

use App\Modules\Models\Criteria\Criteria;
use App\Modules\Models\Eligibility\Eligibility;
use App\Modules\Models\Fee\Fee;
use App\Modules\Models\Intake\Intake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'tbl_programs';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'checklist_documents',
        'image',
        'contact_person',
        'contact_email',
        'contact_number',
        'special_instruction',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];

    public function intakes()
    {
        return $this->hasMany(Intake::class,'program_id','id');
    }

    public function fees()
    {
        return $this->hasMany(Fee::class,'program_id','id');
    }

    public function eligibilities()
    {
        return $this->hasMany(Eligibility::class,'program_id','id');
    }

    public function criterias()
    {
        return $this->hasMany(Criteria::class,'program_id','id');
    }


}
