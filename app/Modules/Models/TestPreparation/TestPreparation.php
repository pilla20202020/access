<?php

namespace App\Modules\Models\TestPreparation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPreparation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
    ];
}
