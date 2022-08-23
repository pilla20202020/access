<?php

namespace App\Modules\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentField extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
    ];
}
