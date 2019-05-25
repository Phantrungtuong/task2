<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Thêm sửa xóa với Ajax trong Laravel</title>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/app1.min.css')}}">
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <style>
        input[type="text"]:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="row center" style="background-color: #30336b">
            {{--form--}}
            <div class="col-md-12 ">
                <div class="col-md-9 center">
                    <h3>Form Thêm Dữ Liệu</h3>
                </div>
                <div class="row">
                    <div class="col-md-5 ">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" style="border-radius: 0px !important;" class="form-control" name="name" id="name" >
                            @if($errors->has('name'))
                                <i  style="color:red;">{{$errors->first('name')}}</i>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label >Email address</label>
                            <input type="text" style="border-radius: 0px !important;" class="form-control" name="email" id="email" >
                            @if($errors->has('email'))
                                <i  style="color:red;">{{$errors->first('email')}}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label >Gender </label><br>
                            <input  type="radio" name="gender" id="gender" value="male"> &nbsp;Male &nbsp;&nbsp;&nbsp;
                            <input  type="radio" name="gender" id="gender" value="female">&nbsp Female
                            @if($errors->has('gender'))
                                <i  style="color:red;">{{$errors->first('gender')}}</i>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>City</label>
                            <select name="city" id="city" class="form-control" >
                                <option style="background-color: #30336b !important;" value="Hà Nội">Hà Nội</option>
                                <option style="background-color: #30336b !important;" value="Hồ Chí Minh">Hồ Chí Minh</option>
                                <option style="background-color: #30336b !important;" value="Đà Nẵng">Đà Nẵng</option>
                                <option style="background-color: #30336b !important;" value="Nha Trang">Nha Trang</option>
                                <option style="background-color: #30336b !important;" value="Huế">Huế</option>
                            </select>
                            @if($errors->has('city'))
                                <i  style="color:red;">{{$errors->first('city')}}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Hobby</label>
                            <div class="demo-inline-wrapper">
                                <input type="checkbox" id="hobby" name="hobby">&nbsp;Play Piano &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="football">&nbsp;Football &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="guitar">&nbsp;Guitar &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="food">&nbsp;Food &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="travel">&nbsp; Travel &nbsp;&nbsp;&nbsp;
                            </div>
                            @if($errors->has('hobby'))
                                <i  style="color:red;">{{$errors->first('hobby')}}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            @if($errors->has('note'))
                                <i  style="color:red;">{{$errors->first('note')}}</i>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <input type="button" id="addstaff" class="btn" style="background-color: white; outline: black" value="Send    ">
                    </div>

                </div>
            </div>
            <div class="col-sm">
                <div class="col-md-12">
                    <div class="col-md-0 ">

                        <div>

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #30336b">
            {{--table list--}}
            <div class="col-md-12" style="color: white">
                <div class="col-md-12 ">
                    <h3>List Data</h3>
                </div>
                <div class="col-md-12 ">
                    <table class="table" id="staffTable" style="color: white" >
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col"> Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Event</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            //get Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //get data form database and show list data
            fetchRecords();
            function fetchRecords(){
                $.ajax({
                    url: 'getstaff', //get url từ route
                    type: 'get', //kiể get
                    dataType: 'json', //dạng dữ liệu json
                    success: function (response) {
                        var len = 0;
                        $('#staffTable tbody tr:not(:first)').empty();//clear thẻ tbody
                        if (response['data'] != null){ //nếu có data
                            len = response['data'].length; //gán len bằng độ dài của data
                        }
                        if (len > 0){
                            for (var i =0 ; i < len; i++){ //vòng lặp get từng dữ liêu data
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;
                                var email = response['data'][i].email;
                                var gender = response['data'][i].gender;
                                var tr_str = "<tr>"+ //khỏi tạo biến chứa thông tin từng record
                                                "<td><input style='background-color:  none; background: none; border:none;  color: white; max-width: 5px' type='text'   id='id_"+id+"' value='"+ id +"' disabled></td>" +
                                                "<td><input style='background-color:  none; background: none; border:none; border-bottom: 1px solid white; color: white' type='text'  id='name_"+id+"' value='"+ name +"' placeholder='"+ name +"' autocomplete='off'></td>" +
                                                "<td><input style='background-color:  none; background: none; border:none; border-bottom: 1px solid white; color: white' type='text'  id='email_"+id+"' value='"+ email +"'  placeholder='"+ email +"' autocomplete='off'></td>" +
                                                "<td><input style='background-color:  none; background: none; border:none; border-bottom: 1px solid white; color: white' type='text'  id='gender_"+id+"' value='" + gender + "'  placeholder='"+ gender +"' autocomplete='off'></td>" +
                                                "<td><a href='' class='update' data-id='"+ id +"'>Update</a>&nbsp;/&nbsp;<a href='' class='delete' data-id='"+ id +"'>Delete</a></td>"+
                                            "</tr>"
                                $("#staffTable tbody").append(tr_str);
                            }
                        }
                        else{
                            var tr_str = "<tr class='nonerecord'>"+
                                            "<td align='center' colspan='5'>No Record Found</td>"+
                                         "</tr>";
                            $("#staffTable tbody").append(tr_str); //chạy biến tr_str tại thẻ có tbody trong thẻ chứa id staffTable
                        }

                    }
                });
            }

            //thêm một bản ghi mới
            $('#addstaff').click(function () {
                //khởi tạo và gán value thừ thẻ có id tương ứng
                var name = $('#name').val();
                var email = $('#email').val();
                var gender = $('#gender').val();
                var city = $('#city').val();
                var hobby = $('#hobby').val();
                var note = $('#note').val();

                if (name != '' && email != '' && gender != '' && city != '' && hobby != ''){
                    $.ajax({
                        url: 'addstaff' , //get url trong route
                        type: 'post', //kiểu post
                        data: { name: name, email: email, gender: gender, city: city, hobby: hobby, note: note}, //gửi data qua controller
                        success: function (response) {
                            if (response > 0){
                                alert('Add Staff Successfully'); //thông báo nếu thành công
                                //clear tất cả input
                                $('#name').val('');
                                $('#email').val('');
                                $('#gender').val('');
                                $('#city').val('');
                                $('#hobby').val('')
                                $('#note').val('')
                            }
                            else {
                                 alert('Fail');
                            }
                        }
                    });
                }
                else{
                    alert('chưa điền đầy đủ thông tin')
                }
            });

            // edit record
            $(document).on("click", ".update", function () {
                var edit_id = $(this).data('id'); //khởi tạo và gán giá trị
                var name = $('#name_'+edit_id).val();//khởi tạo và gán giá trị theo id
                var email = $('#email_'+edit_id).val();
                var gender = $('#gender_'+edit_id).val();

                if (name != '' && email != '' && gender != ''){
                    $.ajax({
                        url: 'updatestaff', //get url trong route
                        type: 'post', //kiểu post
                        data: {editid: edit_id, name: name, email: email, gender: gender}, //gửi data qua controller
                        success: function (response) {
                            alert(response)
                        }
                    });
                }
                else {
                    alert('Hãy thay đổi data trước')
                }
            });



            //delete record
            $(document).on("click", ".delete", function () {
                var delete_id = $(this).data('id'); //khởi tạo và gán dữ liệu
                var el = this; //khởi tạo và gán dữ liệu
                $.ajax({
                    url: 'deletestaff/'+delete_id, //get url trong route kèm them id
                    type: 'get', //kiểu get
                    success: function (response) {
                        $(el).closest("tr").remove(); //xóa bản ghi
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>
</html>