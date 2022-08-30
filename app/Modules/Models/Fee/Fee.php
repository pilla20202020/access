<?php

namespace App\Modules\Models\Fee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'tbl_fees';

    use HasFactory;

    protected $fillable = [
        'title',
        'program_id',
        'type',
        'amount',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];
}
