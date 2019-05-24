<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyModel extends Model
{
    protected $table = 'key';
    protected  $fillable = ['id', 'key'];
    public $timestamps = true;

    public function lock(){
        return $this->hasOne('App\LockModel', 'key_id', 'id');
    }
}
