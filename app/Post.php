<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['id', 'title', 'subtitle', 'slug', 'body', 'status', 'posted_by', 'image', 'like', 'dislike'];
    public $timestamps = true;

    public function tags()
    {
        return $this->belongsToMany('App\Taag','post_taag')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Categories','category_post', 'post_id', 'category_id')->withTimestamps();;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

//    public function getSlugAttribute($value)
//    {
//        return route('post',$value);
//    }

}

