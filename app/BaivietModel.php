<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaivietModel extends Model
{
    protected $table = 'baiviet';
    protected $fillable = ['id', 'id_loaitin', 'id_tags', 'title', 'descriptions', 'content', 'images'];
    public $timestamps = true;


    //mỗi bài viết chỉ thuộc về một loại tin
    public function loaitin(){
        return $this->belongsTo('App\LoaitinModel', 'id_loaitin', 'id');
    }


    //Mỗi bài viết có thể có 1 hoặc nhiều tags
    public function tags(){
        return $this->belongsToMany('App\TagsModel', 'table_accessories', 'id_baiviet', 'id_tags');
    }
}
