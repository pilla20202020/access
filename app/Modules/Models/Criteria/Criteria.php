<?php

namespace App\Modules\Models\Criteria;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'tbl_criterias';

    use HasFactory;

    protected $fillable = [
        'title',
        'program_id',
        'min',
        'max',
        'date',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];
}
