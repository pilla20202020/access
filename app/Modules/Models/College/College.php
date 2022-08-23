<?php

namespace App\Modules\Models\College;

use App\Modules\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country_id',
        'state_id',
        'status',
    ];


    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public static function getColleges()
    {
        return self::select('id', 'name')->where('status', 'Active')->get();
    }

    public static function getCollegesByStateId($state_id)
    {
        return self::select('id', 'name')->where('status', 'Active')->where('state_id',$state_id)->get();
    }

}
