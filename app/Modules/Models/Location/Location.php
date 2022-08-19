<?php

namespace App\Modules\Models\Location;

use App\Modules\Models\Registration\Registration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'tbl_locations';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'description',
        'status',
        'user_id',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class,'preffered_location','slug');
    }


}
