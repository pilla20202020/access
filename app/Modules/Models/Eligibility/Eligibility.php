<?php

namespace App\Modules\Models\Eligibility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    protected $table = 'tbl_eligibilities';

    use HasFactory;

    protected $fillable = [
        'stream',
        'program_id',
        'level',
        'grade',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];
}
