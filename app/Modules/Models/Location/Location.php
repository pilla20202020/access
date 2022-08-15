<?php

namespace App\Modules\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'tbl_locations';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];
}
