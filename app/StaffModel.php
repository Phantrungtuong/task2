<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class StaffModel extends Model
{
    //lấy dữ liệu trong database
    public static function getstaffdata($id=null){
        $value = DB::table('staff')->orderBy('id', 'ASC')->get();
        return $value;
    }

    //insert dữ liệu
    public static function insertdata($data){
        $value=DB::table('staff')->Where('email',$data['email'])->get();
        if ($value->count()==0){
            $insertid=DB::table('staff')->insertGetID($data);
            return $insertid;
        }
        else{
            return 0;
        }
    }

    //sửa
    public static function updatedata($id, $data){
        DB::table('staff')->where('id', $id)->update($data);
    }


    //xóa
    public static function deletedata($id=0){
        DB::table('staff')->where('id', '=', $id)->delete();
    }
}
