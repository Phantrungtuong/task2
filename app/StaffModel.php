<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class StaffModel extends Model
{
    protected $table = 'staff';
    protected $fillable = ['id', 'name', 'email', 'gender', 'city', 'hobby', 'note'];
    public $timestamps = true;

}
