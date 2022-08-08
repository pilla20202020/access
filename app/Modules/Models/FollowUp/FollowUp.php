<?php

namespace App\Modules\Models\FollowUp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'refrence_id',
        'follow_up_type',
        'next_schedule',
        'follow_up_name',
        'follow_up_by',
        'remarks',
        'status',
        'created_by',
        'last_updated_by'
    ];


}
