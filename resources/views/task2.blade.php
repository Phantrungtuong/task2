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

        <div class="row" style="background-color: #30336b">
            {{--form--}}
            <div class="col-sm">
                <div class="col-md-12">
                    <div class="col-md-9 center">
                        <h3>Form Thêm Dữ Liệu</h3>
                    </div>
                    <div class="col-md-12 col-md-push-2">

                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" style="border-radius: 0px !important;" class="form-control" name="name" id="name" >
                                @if($errors->has('name'))
                                    <i  style="color:red;">{{$errors->first('name')}}</i>
                                @endif
                            </div>
                            <div class="form-group">
                                <label >Email address</label>
                                <input type="text" style="border-radius: 0px !important;" class="form-control" name="email" id="email" >
                                @if($errors->has('email'))
                                    <i  style="color:red;">{{$errors->first('email')}}</i>
                                @endif
                            </div>
                            <div class="form-group">
                                <label >Gender: </label>&nbsp;
                                <input  type="radio" name="gender" id="geder" value="male"> &nbsp;Male &nbsp;&nbsp;&nbsp;
                                <input  type="radio" name="gender" id="gender" value="female">&nbsp Female
                                @if($errors->has('gender'))
                                    <i  style="color:red;">{{$errors->first('gender')}}</i>
                                @endif
                            </div>
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
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Hobby</label>
                                <div class="demo-inline-wrapper">
                                    <input type="checkbox" id="hobby" name="hobby">&nbsp;Play Piano <br>
                                    <input type="checkbox" name="football">&nbsp;Football <br>
                                    <input type="checkbox" name="guitar">&nbsp;Guitar <br>
                                    <input type="checkbox" name="food">&nbsp;Food <br>
                                    <input type="checkbox" name="travel">&nbsp; Travel <br>
                                </div>
                                @if($errors->has('hobby'))
                                    <i  style="color:red;">{{$errors->first('hobby')}}</i>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                @if($errors->has('note'))
                                    <i  style="color:red;">{{$errors->first('note')}}</i>
                                @endif
                            </div>
                            <div>
                                <input type="button" id="addstaff" class="btn" style="background-color: white; outline: black" value="Send    ">
                            </div>
                            <br>
                    </div>
                </div>
            </div>
            {{--table list--}}
            <div class="col-sm" style="color: white">
                <div class="col-md-9 center">
                    <h3>List Data</h3>
                </div>
                <div class="col-md-6 col-md-push-12">
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetchRecords();

            function fetchRecords(){
                $.ajax({
                    url: 'getstaff',
                    type: 'get',
                    dataType: 'json',
                    success: function (response) {
                        var len = 0;
                        $('#staffTable tbody tr:not(:first)').empty();
                        if (response['data'] != null){
                            len = response['data'].length;
                        }
                        if (len > 0){
                            for (var i =0 ; i < len; i++){
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;
                                var email = response['data'][i].email;
                                var gender = response['data'][i].gender;

                                var tr_str = "<tr>"+
                                                "<td></td>" +
                                                "<td><input type='text' value='" + name + "' id='name_"+id+"'></td>" +
                                                "<td><input type='text' value='" + email + "' id='email_"+id+"'></td>" +
                                                "<td><input type='text' value='" + gender + "' id='gender_"+id+"'></td>" +
                                                "<td><a class='update' data-id='"+ id +"'>Update</a>&nbsp;/&nbsp;<a class='delete' data-id='"+ id +"'>Delete</a></td>"+
                                            "</tr>"
                                $("#staffTable tbody").append(tr_str);
                            }
                        }
                        else{
                            var tr_str = "<tr class='nonerecord'>"+
                                            "<td align='center' colspan='5'>No Record Found</td>"+
                                         "</tr>";
                            $("#staffTable tbody").append(tr_str);
                        }

                    }
                });
            }
                $('#addstaff').click(function () {

                    var name = $('#name').val();
                    var email = $('#email').val();
                    var gender = $('#gender').val();
                    var city = $('#city').val();
                    var hobby = $('#hobby').val();
                    var note = $('#note').val();
                    
                    if (name != '' && email != '' && gender != '' && city != '' && hobby != ''){
                        $.ajax({
                            url: 'addstaff' ,
                            type: 'post',
                            data: { name: name, email: email, gender: gender, city: city, hobby: hobby, note: note},
                            success: function (response) {
                                if (response > 0){
                                    alert('Add Staff Successfully');
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
        });
    </script>
</body>
</html>