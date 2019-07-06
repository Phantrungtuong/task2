<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Thêm sửa xóa với Ajax trong Laravel</title>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
{{--    <link rel="stylesheet" href="{{URL::asset('css/app1.min.css')}}">--}}
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <style>
        input[type="text"]:focus {
            outline: 0 !important;
            box-shadow: none;
            background: none;
            color: white;
        }
        textarea, select:focus {
            outline: 0 !important;
            box-shadow: none !important;
            background: none !important;
            color: white !important;
        }
        body{
            color: white;
        }
        .style{
            background: none;
            border:none;
            border-bottom: 1px solid white;
            color: white;
            border-radius: 0px !important;
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
                    @if(Auth::check())
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            Logout
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none; background: #e74c3c; border-color: #e74c3c">
                    <ul></ul>
                </div>
                <div>

                </div>
                <div class="row">
                    <div class="col-md-5 ">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control style" name="name" id="name" >
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label >Email address</label>
                            <input type="text"  class="form-control style" name="email" id="email" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label >Gender </label><br>
                            <input  type="radio" name="gender" id="gender" value="Male" checked> &nbsp;Male &nbsp;&nbsp;&nbsp;
                            <input  type="radio" name="gender" id="gender" value="Female">&nbsp Female
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>City</label>
                            <select name="city" id="city" class="form-control style" style="background: none; color: white">
                                <option value="" disabled selected>Chose Your City</option>
                                <option style="background-color: #30336b !important;" value="Hà Nội">Hà Nội</option>
                                <option style="background-color: #30336b !important;" value="Hồ Chí Minh">Hồ Chí Minh</option>
                                <option style="background-color: #30336b !important;" value="Đà Nẵng">Đà Nẵng</option>
                                <option style="background-color: #30336b !important;" value="Nha Trang">Nha Trang</option>
                                <option style="background-color: #30336b !important;" value="Huế">Huế</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Hobby</label>
                            <div class="demo-inline-wrapper">
                                <input type="checkbox" name="hobby" id="hobby" value="Piano">&nbsp;Play Piano &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="hobby" id="football" value="Football">&nbsp;Football &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="hobby" id="guitar" value="Guitar">&nbsp;Guitar &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="hobby" id="food" value="Food">&nbsp;Food &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="hobby" id="travel" value="Travel">&nbsp; Travel &nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control style" id="note" name="note" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <input type="button" id="addstaff" class="btn btn-outline-success"  value="Send">
                        <input type="button" id="reset" class="btn btn-outline-light"  value="Reset">
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
                <div class="col-md-12 " >
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

            $('#reset').click(function () {
                $('input[type=text]').val('');
                $('input[type=radio]').val('');
                $('select[name="city"]').val('');
                $('input[type=checkbox]').prop('checked',false);
                $('textarea[name="note"]').val('')
            })


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
                                var tr_str = "<tr id='list'>"+ //khỏi tạo biến chứa thông tin từng record
                                                "<td><input style='background-color:  none; background: none; border:none;  color: white; max-width: 50px' type='text'   id='id_"+id+"' value='"+ id +"' disabled></td>" +
                                                "<td><input style='background-color:  none; background: none; border:none; border-bottom: 1px solid white; color: white' type='text'  id='name_"+id+"' value='"+ name +"' placeholder='"+ name +"' autocomplete='off'></td>" +
                                                "<td><input style='background-color:  none; background: none; border:none; border-bottom: 1px solid white; color: white' type='text'  id='email_"+id+"' value='"+ email +"'  placeholder='"+ email +"' autocomplete='off'></td>" +
                                                "<td>" +
                                                        "<select style='background-color:  none; background: none; border:none; border-bottom: 1px solid white; color: white' type='text'  id='gender_"+id+"' value='" + gender + "'  placeholder='"+ gender +"' autocomplete='off'>" +
                                                            "<option value='"+gender+"' selected disabled>"+gender+"</option>"+
                                                            "<option style='background-color: #30336b;' value='Male' >Male</option>"+
                                                            "<option style='background-color: #30336b;' value='Female' >Female</option>"+
                                                        "</select>"+
                                                "</td>" +
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
                // var name = $('#name').val();
                // var email = $('#email').val();
                // var gender = $('#gender').val();
                // var city = $('#city').val();
                // var hobby = $('#hobby').val();
                // var note = $('#note').val();



                var name = $('input[name="name"]').val();
                var email = $('input[name="email"]').val();
                var gender = $('input[name="gender"]').val();
                var city = $('select[name="city"]').val();
                var hobby = $('input[type=checkbox]:checked').map(function(_, el){
                    return $(el).val();
                }).get();
                var note = $('textarea[name="note"]').val();
                if (name != '' && email != '' && gender != '' && city != '' && hobby != ''){
                    $.ajax({
                        url: 'addstaff' , //get url trong route
                        type: 'post', //kiểu post
                        data: { name: name, email: email, gender: gender, city: city, hobby: hobby.toString(), note: note}, //gửi data qua controller
                        success: function (response) {
                            if($.isEmptyObject(response.errors)){
                                alert('Add Staff Successfully'); //thông báo nếu thành công

                                setInterval(function () {
                                    $('#tablelist').load(fetchRecords()).fadeIn("slow");
                                }, 500);
                                //clear tất cả input
                                $('input[type=text]').val('');
                                $('input[type=radio]').val('');
                                $('select[name="city"]').val('');
                                $('input[type=checkbox]').prop('checked',false);
                                $('textarea[name="note"]').val('')
                            }else{
                                $(".print-error-msg").find("ul").html('');
                                $(".print-error-msg").css('display','block');
                                $.each( response.errors, function( key, value ) {
                                    $(".print-error-msg").find("ul").append('<li style="list-style-type: none; color:white">'+value+'</li>');
                                });
                                $("div.alert").delay(3000).slideUp();
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
                        success: function (data) {
                            alert('Add Staff Successfully');
                            setInterval(function () {
                                $('#list').load(fetchRecords()).fadeIn("slow");
                            }, 500);
                        }
                    });

                }
                else {
                    alert('Hãy thay đổi data trước')
                }
            });



            //delete record
            $(document).on("click", ".delete", function () {
                var del_id = $(this).data('id');
                var el = this;
                if (confirm("Are you sure you want to delete this Record?")){
                    $.ajax({
                        url: 'deletestaff/' +del_id, //get url trong route
                        type: 'get', //kiểu get
                        success: function () {
                            $(this).parents("#list").animate("fast").animate({
                                opacity : "hide"
                            }, 500);
                        }
                    });


                }
                return false

            });
        });
    </script>
</body>
</html>