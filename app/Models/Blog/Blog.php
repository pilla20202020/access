<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;
use App\User;

class Blog extends Model
{
    use Sluggable;

  

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
      
        'slug',
        'title',
        'content',
        'user_id',
        'is_featured',
        'is_published'
    ];

    public function excerpt()
    {
        return Str::limit($this->content, Blog::EXCERPT_LENGTH);
    }

    /**
     * The attributes that should be typecast into boolean.
     *
     * @var array
     */

//    protected $dates = ['date'];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected $appends = [
       'thumbnail_path', 'image_path','icon_path'
    ];
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $query
     * @param bool $type
     * @return mixed
     */
    public function scopePublished($query, $type = true)
    {
        return $query->where('is_published', $type);
    }

    /**
     * @param $query
     * @param bool $type
     * @return mixed
     */
    public function scopeFeatured($query, $type = true)
    {
        return $query->where('is_featured', $type);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}

