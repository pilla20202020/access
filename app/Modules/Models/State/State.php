<?php

namespace App\Modules\Models\State;

use App\Modules\Models\Country\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_name',
        'country_id',
        'status',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function getStates()
    {
        return self::select('id','state_name')->where('status','Active')->get();
    }

    public static function getStatesByCountryId($country_id)
    {
        return self::select('id','state_name')->where('status','Active')->where('country_id',$country_id)->get();
    }
}
