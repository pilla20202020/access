<?php

namespace App\Modules\Models\Intake;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    protected $table = 'tbl_intakes';

    use HasFactory;

    protected $fillable = [
        'title',
        'program_id',
        'intake_date',
        'class_commencement',
        'deadline_date',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];
}
