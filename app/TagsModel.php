<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagsModel extends Model
{
    protected $table = 'tags';
    protected $fillable =['id', 'name'];
    public $timestamps = true;


    //Mỗi thẻ có thể có 1 hoặc nhiều bài viết
    public function baiviet(){
        return $this->belongsToMany('App\BaivietModel', 'table_accessories', 'id_tags', 'id_baiviet');
    }
}
