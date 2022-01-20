@extends('layouts.admin')

@section('page_title')
    Manage Users
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('manageusers')}}">Manage Users</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="formUser">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <input type="hidden" id="UsrId" name="UsrId">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="RegNumber">Username</label>
                                <input type="text" name="Username" class="form-control" id="Username" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <label for="AccStatus">Account Status</label>
                                <select class="form-control" id="AccStatus" name="AccStatus">
                                    <option value="">Choose a Status...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactivated</option>

                                </select>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="AccType">Account Type</label>
                                <select class="form-control" id="AccType" name="AccType">
                                    <option value="">Choose a Type...</option>
                                    <option value="a">Admin</option>
                                    <option value="u">User</option>
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
                    <button type="button" id="btnClear" onclick="clear_form()" class="btn btn-default">Clear</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">View Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="AccType2">User Type</label>
                            <select class="form-control" id="AccType2" name="AccType2">
                                <option value=" ">All</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="AccStatus2">Status</label>
                            <select class="form-control" id="AccStatus2" name="AccStatus2">
                                <option value=" ">All</option>
                                <option value="Active">Active</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                        </div>
                    </div>
                </div>

                <table id="usersTable" class="table table-bordered table-hover">
                    <thead class="text-center">
                    <tr>
                        <th>Username</th>
                        <th>Account Type</th>
                        <th>Status</th>
                        <th>Options</th>

                    </tr>
                    </thead>
                    <tbody class="text-center">


                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function (){



            $('#formUser').validate({
                rules: {
                    Username: {
                        required: true,

                    },
                    AccStatus: {
                        required: true,

                    },
                    AccType: {
                        required: true,

                    },
                    UsrEmail: {
                        email: true
                    },



                },
                messages: {
                    UsrEmail: {
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
                if ($("#formUser").valid()) {

                    if(   $('#btnSave').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType= 'update';
                    }


                    f = new FormData($("#formUser")[0]);
                    f.append('formType',$formType);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('users.create')}}",
                    }).done(function (response) {

                        // $("#frmCustomer").reset();
                        // $('#frmCustomer')[0].reset();
                        // table.draw();
                        // alert(response.type);
                        if (response.type === 0){
                            Swal.fire({
                                icon: 'error',
                                title: 'Exist',
                                text: 'Existing Username !',


                            })

                        }else if (response.type === 1){

                            Swal.fire({
                                title: '<strong>User Created ! </strong>',
                                icon: 'success',
                                html:
                                    '<b>Username :</b> '+response.data.name +'<br>'+
                                    '<b>Password :</b> '+response.pwd,
                                showCloseButton: true,
                                willClose: () => {
                                    table.ajax.reload();
                                    $('#formUser')[0].reset();
                                }
                            })
                        }else if(response.type === 2){
                            Swal.fire({
                                title: '<strong>User Updated ! </strong>',
                                icon: 'success',
                                html:
                                    '<strong> '+response.data.name+'</strong> updated successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    table.ajax.reload();
                                    // $('#formUser')[0].reset();
                                    clear_form();
                                }
                            })
                        }

                    })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            alert(textStatus);
                        });

                }
            });

            $('#AccType2').change(function (){
                table.column(1).search($(this).val()).draw();
            });

            $('#AccStatus2').change(function (){
                table.column(2).search($(this).val()).draw();
            });

        });

        var table = $('#usersTable').DataTable({

            'processing': true,
            // 'serverSide': true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'copy',
                    text: '<i class=\'fa fa-copy  pink\'></i> <span class=\'hidden\'>Copy </span>'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class=\'fa fa-file-excel \'></i> <span class=\'hidden\'> Excel</span>'
                },
                {
                    extend: 'colvis',
                    text: '<i class=\'fa fa-eye-slash \'></i> <span class=\'hidden\'>Show / Hide Columns</span>'
                },

                {
                    extend: 'pdfHtml5',
                    text: '<i class=\'fa fa-file-pdf \'></i> <span class=\'hidden\'>PDF</span>'
                }
                // 'pdfHtml5'
            ],
            'ajax': {

                url: "{{route('users.get')}}",
            },

            "columnDefs": [

            ]

        });

        // change default button action
        var defaultPDFAction = table.button(3).action();
        table.button(3).action(function (e, dt, button, config) {

            pdf();
        });


        function edit_user(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"users.get_one/"+id,

            }).done(function (response) {
                // console.log(response);
                $('#UsrId').val(response.id);
                $('#Username').val(response.name);
                $('#Username').prop('readonly',true);
                $('#AccType').val(response.acttype);
                $('#AccStatus').val(response.status);
                $('#UsrEmail').val(response.email);


                $('#btnSave').text('Update');


            });
        }

        function pdf() {
            alert('pdf');
        }

        function reset_user(id){
            // alert(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reset password !'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )

                    $.ajax({

                        type: "GET",
                        dataType:'json',
                        processData: false,
                        contentType: false,
                        url:"users.reset/"+id,

                    }).done(function (response) {

                        if (response.type === 1){

                            Swal.fire({
                                title: '<strong>Password Reset Success ! </strong>',
                                icon: 'success',
                                html:
                                    '<b>Username :</b> '+response.data.name +'<br>'+
                                    '<b>Password :</b> '+response.pwd,
                                showCloseButton: true,
                                // willClose: () => {
                                //     table.ajax.reload();
                                //     $('#formUser')[0].reset();
                                // }
                            })
                        }

                    });
                }
            })
        }

        function clear_form(){
            $('#formUser')[0].reset();
            $('#Username').prop('readonly',false);
            $('#btnSave').text('Save');
        }


    </script>
@endsection
