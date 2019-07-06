<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

use App\Http\Requests\StaffRequest;
use App\StaffModel;
use Validator;
class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getajax(){
        return view('task2');
    }
    public function getStaff(){
        $StaffData['data'] = StaffModel::all();
        echo json_encode($StaffData);
    }

    public function addStaff(Request $req){
        $validator = Validator::make($req->all(),
            [
                'name'=>'required|max:225',
                'email'=>'required|email|max:225|unique:staff',
                'gender'=>'required',
                'city'=>'required',
                'hobby'=>'required',
                'note'=>'max:500',
            ],
            [
                'name.required'=> trans('validation.required'),
                'name.max'=> trans('validation.max'),
                'email.required'=> trans('validation.required'),
                'email.email'=> trans('validation.email'),
                'email.max'=> trans('validation.max'),
                'email.unique'=> trans('validation.unique'),
                'gender.required'=> trans('validation.required'),
                'city.required'=> trans('validation.required'),
                'hobby.required'=> trans('validation.required'),
                'note.max'=> trans('validation.max'),
            ]);
            if ($validator->passes()){
                $value = new StaffModel();
                $value->name = $req->input('name');
                $value->email = $req->input('email');
                $value->gender = $req->input('gender');
                $value->city = $req->input('city');
                $value->hobby = $req->input('hobby');
                $value->note = $req->input('note');

                $value->save();
                if ($value) {
                    return response()->json(['success'=>'Add Successfuly']);
                }
            }
            else{
                return response()->json(['errors'=>$validator->errors()->all()]);
            }
    }

    public function updateData(Request $req){
        $id = $req->input('editid');
        StaffModel::where('id', '=', $id)->update([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'gender' => $req->input('gender'),
        ]);

    }



    public function deletedata($id){
        StaffModel::where('id', $id)->delete();
        echo "Delete Successfully";
    }


}
