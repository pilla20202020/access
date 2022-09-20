<?php

namespace App\Modules\Models\Registration;

use App\Modules\Models\Campaign\Campaign;
use App\Modules\Models\FollowUp\FollowUp;
use App\Modules\Models\LeadCategory\LeadCategory;
use App\Modules\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'tbl_registrations';

    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zone',
        'nearest_landmark',
        'preffered_location',
        'see_year',
        'see_grade',
        'headers',
        'country_id',
        'state_id',
        'district_id',
        'municipality_name',
        'ward_no',
        'village_name',
        'full_address',
        'user_agent',
        'see_stream',
        'see_school',
        'plus2_year',
        'plus2_grade',
        'plus2_stream',
        'plus2_college',
        'bachelors_year',
        'bachelors_grade',
        'bachelors_stream',
        'bachelors_college',
        'highest_qualification',
        'highest_grade',
        'highest_stream',
        'highest_college',
        'preparation_class',
        'preparation_score',
        'preparation_bandscore',
        'preparation_date',
        'test_name',
        'coupen_code',
        'test_score',
        'intrested_for_country',
        'intrested_course',
        'source',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];

    public static function getFollowUp($id)
    {
        return FollowUp::select('id','next_schedule','follow_up_name','follow_up_by','remarks')->where('follow_up_type','registration')->where('refrence_id',$id)->latest()->first();
    }

    public static function getFollowUpCount($id)
    {
        return FollowUp::select('id','next_schedule','follow_up_name','follow_up_by','remarks')->where('follow_up_type','registration')->where('refrence_id',$id)->latest()->get();
    }

    public function leadcategory()
    {
        return $this->belongsTo(LeadCategory::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function enroll($id) {
        return Student::select('id')->where('source_ref','registration')->where('ref_id',$id)->latest()->first();
    }
}
