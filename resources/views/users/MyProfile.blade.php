@extends('layouts.admin')

@section('page_title')
    My Profile
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('myprofile')}}">My Profile</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->
      {{--  <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="formUser">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="RegNumber">Registration Number</label>
                                <input type="text" name="RegNumber" class="form-control" id="RegNumber" placeholder="Registration Number">
                            </div>

                            <div class="form-group">
                                <label for="AccStatus">Account Status</label>
                                <select class="form-control" id="AccStatus" name="AccStatus">
                                    <option value="">Choose a Status...</option>
                                    <option value="A">Active</option>
                                    <option value="U">Blocked</option>
                                    <option value="D">Deactivated</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="AccType">Account Type</label>
                                <select class="form-control" id="AccType" name="AccType">
                                    <option value="">Choose a Type...</option>
                                    <option value="A">Admin</option>
                                    <option value="U">User</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="UsrEmail">Email</label>
                                <input type="email" name="UsrEmail" class="form-control" id="UsrEmail" placeholder="Enter Email">
                            </div>


                        </div>
                    </div>



                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-default">Clear</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>--}}
        <!-- /.card -->

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-dark card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="../../dist/img/user4-128x128.jpg"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"> <span id="spnUsrName"> </span> </h3>

                        <p class="text-muted text-center"> <span id="spnUsrType"></span> </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-dark">
                    <div class="card-header p-2">
                        Settings
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" id="frmUser">
                                    @csrf

                                    <input type="hidden" id="UsrId" name="UsrId">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Name" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="UsrEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="UsrEmail" placeholder="Email" name="UsrEmail">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="UsrPassword" class="col-sm-2 col-form-label">Current Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="UsrCPassword" name="UsrCPassword" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="UsrPassword" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="UsrNPassword" name="UsrNPassword" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="UsrCPassword" class="col-sm-2 col-form-label">Confirm New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="UsrCNPassword" name="UsrCNPassword" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group row text-right">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="button" id="btnClear" onclick="get_profile_info()" class="btn btn-default">Clear</button>
                                            <button type="button" class="btn btn-primary" id="btnSave">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function (){

            get_profile_info();


            $('#frmUser').validate({
                rules: {
                    username: {
                        required: true,

                    },
                    UsrCPassword: {
                        required: true,

                    },
                    UsrNPassword: {
                        // required: true,

                    },

                    UsrCNPassword: {
                        // required: true,
                        equalTo: "#UsrNPassword"

                    },
                    UsrEmail: {
                        email: true
                    },



                },
                messages: {
                    UsrEmail: {
                        // required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    }

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#btnSave').click(function (e) {
                if ($("#frmUser").valid()) {


                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });

                    f = new FormData($("#frmUser")[0]);

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('profile.update')}}",
                    }).done(function (response) {

                        // $("#frmCustomer").reset();
                        // $('#frmCustomer')[0].reset();
                        // table.draw();
                        // alert(response.type);
                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Username !',


                            })

                        } else if (response.type === 1){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Email !',


                            })

                        } else if (response.type === 2){
                            Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized !',
                                text: 'Not authorized to Update !',


                            })

                        } else if (response.type === 3) {

                            Swal.fire({
                                icon: 'warning',
                                title: 'Invalid !',
                                text: 'Invalid Password !',
                            })

                        }else if(response.type === 4){
                            Swal.fire({
                                title: '<strong>Profile Updated ! </strong>',
                                icon: 'success',
                                html: 'Profile updated successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    get_profile_info();
                                }

                            })
                        }

                    })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            alert(textStatus);
                        });

                }
            });

        });

        function get_profile_info(id="{{Auth::user()->id}}"){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"users.get_one/"+id,

            }).done(function (response) {
                console.log(response);
                $('#UsrId').val(response.id);
                $('#username').val(response.name);
                $('#UsrEmail').val(response.email);
                $('#UsrCPassword').val("");
                $('#UsrNPassword').val("");
                $('#UsrCNPassword').val("");


                var usrType = response.acttype === "a" ? "Admin" : "User";

                $('#spnUsrType').html(usrType);
                $('#spnUsrName').html(response.name);

            });
        }
    </script>
@endsection
