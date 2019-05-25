<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//task1
route::group(['prefix'=>'relationship'], function (){

    //mỗi khóa chỉ thuộc 1 key
    route::get('has-one-key', function (){
       $data =  App\KeyModel::find(4)->lock()->get()->toArray();
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    });


    //mỗi key chỉ thuộc môt khóa
    route::get('has-one-lock', function (){
        $data =  App\LockModel::find(2)->key()->get()->toArray();
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    });

    //một loại tin có thể có một hoặc nhiều bài viết
   route::get('has-many', function (){
       $data = App\LoaitinModel::find(1)->baiviet()->get()->toArray();
       echo "<pre>";
       print_r($data);
       echo "</pre>";
   });

    //Mỗi bài viết chỉ thuộc một loại tin duy nhất
   route::get('belongs-to', function (){
        $data = App\BaivietModel::find(3)->loaitin()->get()->toArray();
       echo "<pre>";
       print_r($data);
       echo "</pre>";
   });

   //mỗi tags có thể có có 1 hoặc nhiều bài viết
   route::get('tags-baiviet', function (){
       $data = App\TagsModel::with('baiviet')->find(1)->toArray();
       echo "<pre>";
       print_r($data);
       echo "</pre>";
   });

    //mỗi bài viết có thể có 1 hoặc nhiều tags
    route::get('baiviet-tags', function (){
        $data = App\BaivietModel::find(1)->tags()->get()->toArray();
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    });
});

//task 2

Route::group(['prefix'=>'ajax'], function (){
   Route::get('task2', function (){
       return view('task2');
   });
   Route::get('getstaff', ['as'=>'getstaff', 'uses'=>'StaffController@getStaff']);
   Route::post('addstaff','StaffController@addStaff');
   Route::post('updatestaff', ['as'=>'postupdatestaff', 'uses'=>'StaffController@updateData']);
   Route::get('deletestaff/{id}', ['as'=>'getdeletestaff', 'uses'=>'StaffController@deletedata']);
});