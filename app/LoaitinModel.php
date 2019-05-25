<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaitinModel extends Model
{
    protected $table = 'loaitin';
    protected $fillable =['id', 'name', 'descriptions'];
    public $timestamps = true;


    //Mỗi loại tin có thể có 1 hoặc nhiều bài viết
    public  function baiviet(){
        return $this->hasMany('App\BaivietModel', 'id_loaitin', 'id');
    }
}
