<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LockModel extends Model
{
    protected $table = 'lock';
    protected $fillable = ['id', 'name'];
    public $timestamps = true;

    public function key(){
        return $this->belongsTo('App\KeyModel', 'key_id', 'id');
    }
}
