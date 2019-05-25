<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_accessories_Model extends Model
{
    protected $table = 'table_accessories';
    protected $fillable = ['id' ,'id_tags', 'id_baiviet'];
    public $timestamps = true;
}
