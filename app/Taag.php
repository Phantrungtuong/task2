<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taag extends Model
{
    public function posts()
    {
        return $this->belongsToMany('App\Post','post_taag')->orderBy('created_at','DESC')->paginate(5);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
