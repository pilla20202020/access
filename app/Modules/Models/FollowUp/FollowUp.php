<?php

namespace App\Modules\Models\FollowUp;

use App\Modules\Models\Registration\Registration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'refrence_id',
        'follow_up_type',
        'next_schedule',
        'follow_up_name',
        'follow_up_by',
        'remarks',
        'status',
        'created_by',
        'last_updated_by'
    ];

    public static function registration($id)
    {
        $query = DB::select("SELECT f.id,r.name,r.email,r.phone,f.next_schedule,f.follow_up_by,f.remarks FROM tbl_registrations r INNER JOIN follow_ups f ON f.refrence_id = r.id AND f.follow_up_type = 'registration' AND f.id = $id");
        return $query[0];
    }


}
