<?php

namespace App\Modules\Models\Qualification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];
}
