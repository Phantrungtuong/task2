<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StaffRequest;
use App\StaffModel;
class StaffController extends Controller
{

    public function getStaff(){
        $StaffData['data'] = StaffModel::getstaffdata();
        echo json_encode($StaffData);
        exit;
    }

    public function addStaff(StaffRequest $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $gender = $req->input('gender');
        $city = $req->input('city');
        $hobby = $req->input('hobby');
        $note = $req->input('note');

        if ($name != '' && $email != '' && $gender != '' && $city != '' && $hobby != ''){
            $data = array('name' => $name, 'email' => $email, 'gender' => $gender, 'city' => $city, 'hobby' => $hobby, 'note' => $note );

            $value = StaffModel::insertdata($data);
            if ($value){
                echo $value;
            }
            else{
                echo 0;
            }
        }
        else{
            echo "<script>alert('Thông tin các trường chưa được điền đầy đủ')</script>";
        }
        exit;
    }


    public function updateData(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $gender = $req->input('gender');
        $editid = $req->input('editid');

        if ($name != '' && $email != '' && $gender != '' ) {
            $data = array('name' => $name, 'email' => $email, 'gender' => $gender);

            StaffModel::updatedata($editid, $data);
            echo "Updata Successfully";
        }
        else{
            echo "Thông tin các trường chưa được điền đầy đủ";
        }
        exit;
    }


    public function deletedata($id=0){
        StaffModel::deletedata($id);
        echo "Delete Successfully";
        exit;
    }
}
