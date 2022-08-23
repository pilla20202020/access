<?php

namespace App\Modules\Models\Agent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'tbl_agents';

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

}
