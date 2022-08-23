<?php

namespace App\Modules\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLanguage extends Model
{
    use HasFactory;
    protected $table = 'tbl_student_languages';

    protected $fillable = [
        'student_id',
        'language',
        'score',
        'language_documents',
    ];
}
