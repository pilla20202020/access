<?php

namespace App\Modules\Models\LeadCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadCategory extends Model
{
    use HasFactory;
    protected $table = 'tbl_lead_categories';

    protected $fillable = [
        'name',
        'color_code',
        'status',
    ];
}
