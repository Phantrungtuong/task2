<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_role', 'permission_id', 'role_id');
    }
    public function admin(){
        return $this->belongsToMany('App\Admin', 'admin_roles', 'admin_id', 'role_id');
    }
}
