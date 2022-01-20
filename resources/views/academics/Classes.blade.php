@extends('layouts.admin')

@section('page_title')
    Classes
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('classes')}}">Classes</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add Class</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="formClass">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="clsId" id="clsId">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ClsName">Class Name</label>
                                <input type="text" name="ClsName" class="form-control" id="ClsName" placeholder="Name">
                            </div>



                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ClsGrade">Grade</label>
                                <div class="input-group">
                                    <select class="form-control" id="ClsGrade" name="ClsGrade">
                                        <option value="">Choose a Grade...</option>
                                        <option value="A">Admin</option>
                                        <option value="U">User</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="show_modal()"><i class="fas fa-plus"></i></span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>



                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-default" onclick="clear_form()">Clear</button>
                    <button type="button" id="btnSavecls" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Manage Classes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="ClsGrade2">Grade</label>
                                <select class="form-control" id="ClsGrade2" name="ClsGrade2">
                                    <option value="">Choose a Grade...</option>

                                </select>
                            </div>
                        </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="ClsStatus">Status</label>
                                <select class="form-control" id="ClsStatus" name="ClsStatus">
                                    <option value=" ">All</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactivated">Deactivated</option>
                                </select>
                            </div>
                    </div>
                </div>


                <table id="classTable" class="table table-bordered table-hover">
                    <thead>
                    <tr class="text-center">
                        <th>Class</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th>Options</th>

                    </tr>
                    </thead>
                    <tbody class="text-center">

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="modal" id="modalGrades">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Grade</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formGrades">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="GrdName">Grade Name</label>
                                    <input type="text" name="GrdName" class="form-control" id="GrdName" placeholder="Name">
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="GrdSection">Section</label>
                                    <select class="form-control" id="GrdSection" name="GrdSection">
                                    </select>

                                </div>

                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSaveGrd" class="btn btn-primary">Save </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@section('script')
    <script>
        $(document).ready(function (){



            get_active_grades();

            $('#formClass').validate({
                rules: {
                    ClsName: {
                        required: true,
                    },
                    ClsGrade: {
                        required: true,
                    }


                },
                messages: {

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

            $('#formGrades').validate({
                rules: {
                    GrdName: {
                        required: true,
                    },
                    GrdSection: {
                        required: true,
                    }


                },
                messages: {

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

            $('#btnSavecls').click(function (e) {
                if ($("#formClass").valid()) {

                    if(   $('#btnSavecls').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType = 'update';
                    }

                    f = new FormData($("#formClass")[0]);
                    f.append('formType',$formType);

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('classes.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Class Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Class Added ! </strong>',
                                icon: 'success',
                                html: 'Class added successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    // close_modal();
                                    table.ajax.reload();
                                    clear_form();
                                }

                            })
                        }else if(response.type === 2){

                            Swal.fire({
                                title: '<strong>Class Updated ! </strong>',
                                icon: 'success',
                                html: 'Class updated successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    // close_modal();
                                    table.ajax.reload();
                                    clear_form();
                                }

                            });
                        }

                    });
                }
            });

            $('#btnSaveGrd').click(function (e) {
                if ($("#formGrades").valid()) {

                    f = new FormData($("#formGrades")[0]);
                    f.append('formType','save');

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('grade.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Grade Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Grade Added ! </strong>',
                                icon: 'success',
                                html: 'Grade added successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    close_modal();
                                }

                            })
                        }

                    });
                }
            });

        });

        var table = $('#classTable').DataTable({

            'processing': true,
            // 'serverSide': true,
            "order": [

                [ 1, "asc" ]
            ],
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

                url: "{{route('classes.get')}}",
            },

            "columnDefs": [
                { "width": "25%", "targets": 0 },
                { "width": "25%", "targets": 1 },
                { "width": "25%", "targets": 2 },
                { "width": "25%", "targets": 3 }
            ]

        });

        // change default button action
        var defaultPDFAction = table.button(3).action();
        table.button(3).action(function (e, dt, button, config) {

            pdf();
        });

        function show_modal() {
            get_active_sections();
            $('#modalGrades').modal('show');
        }

        function close_modal(){
            $('#GrdName').val("");
            get_active_grades();
            $('#modalGrades').modal('hide');
            // swal.close();
        }

        function get_active_grades(){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"grade.get_active",

            }).done(function (response) {
                $('#ClsGrade').empty().append($('<option>', {
                    value: "",
                    text: 'Choose a Grade...'
                }));
                $('#ClsGrade2').empty().append($('<option>', {
                    value: " ",
                    text: 'All'
                }));
                $.each(response, function (i, item) {
                    $('#ClsGrade').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));

                    $('#ClsGrade2').append($('<option>', {
                        value: item.name,
                        text : item.name
                    }));
                });
            });
        }

        function get_active_sections(){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"section.get_active",

            }).done(function (response) {

                $('#GrdSection').empty().append($('<option>', {
                    value: "",
                    text: 'Select Section !'
                }));
                $.each(response, function (i, item) {

                    $('#GrdSection').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));
                });
            });
        }

        function edit_class(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"classes.get_one/"+id,

            }).done(function (response) {
                console.log(response);
                $('#clsId').val(response.id);
                $('#ClsName').val(response.name);
                $('#ClsGrade').val(response.grade_id);




                $('#btnSavecls').text('Update');


            });
        }

        function toggle_class(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"classes.toggle/"+id,

            }).done(function (response) {
                if(response.type === 1){

                    table.ajax.reload();
                    // Swal.fire({
                    //     title: '<strong>Grade Updated ! </strong>',
                    //     icon: 'success',
                    //     html: 'Grade updated successfully !',
                    //     showCloseButton: true,
                    //     willClose: () => {
                    //         // close_modal();
                    //         table.ajax.reload();
                    //     }
                    //
                    // });
                }


            });
        }

        function clear_form(){
            $('#formClass')[0].reset();
            $('#btnSavecls').text('Save');
        }

        $('#ClsGrade2').change(function (){
            table.column(1).search($(this).val()).draw();
        });

        $('#ClsStatus').change(function (){
            table.column(2).search($(this).val()).draw();
        });
    </script>
@endsection
