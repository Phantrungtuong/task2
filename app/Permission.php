<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable =['id', 'name', 'for'];
    public $timestamps = true;

    public function roles(){
        return $this->belongsToMany('App\Role', 'permission_role', 'role_id', 'permission_id');
    }
}
