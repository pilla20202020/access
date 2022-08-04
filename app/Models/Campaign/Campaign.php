<?php

namespace App\Models\Campaign;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'tbl_campaigns';
    use HasFactory;

    protected $path = 'uploads/campaign';

    protected $fillable = [
        'name',
        'alias',
        'details',
        'banner',
        'ogImage',
        'starts',
        'ends',
        'ogtags',
        'success_message',
        'sms_message',
        'coupon_codes',
        'url',
        'keywords',
        'description',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];

    protected $appends = [
        'thumbnail_path', 'banner_path'
    ];

    function getBannerPathAttribute()
    {
        return $this->path . '/' . $this->banner;
    }

    function getThumbnailPathAttribute()
    {
        return $this->path . '/thumb/' . $this->banner;
    }
}
