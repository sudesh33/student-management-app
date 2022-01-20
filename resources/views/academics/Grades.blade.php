@extends('layouts.admin')

@section('page_title')
    Grades
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('grades')}}">Grades</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add Grade</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="formGrades">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="grdId" id="grdId">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="GrdName">Grade Name</label>
                                <input type="text" name="GrdName" class="form-control" id="GrdName" placeholder="Name">
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="GrdSection">Section</label>
                                <div class="input-group">
                                    <select class="form-control" id="GrdSection" name="GrdSection">
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
                    <button type="button" id="btnSaveGrd" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Manage Grades</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="GrdSection2">Section</label>
                            <select class="form-control" id="GrdSection2" name="GrdSection2">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="GrdStatus">Status</label>
                            <select class="form-control" id="GrdStatus" name="GrdStatus">
                                <option value=" ">All</option>
                                <option value="Active">Active</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                        </div>
                    </div>
                </div>




                <table id="gradesTable" class="table table-bordered table-hover">
                    <thead class="text-center">
                    <tr>
                        <th>Grade</th>
                        <th>Section</th>
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

    <div class="modal" id="modalSections">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Section</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formSection">
                        @csrf
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="SecName">Section Name</label>
                                <input type="text" name="SecName" class="form-control" id="SecName" placeholder="Name">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save </button>
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

            get_active_sections();

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

            $('#formSection').validate({
                rules: {
                    SecName: {
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



            $('#btnSaveGrd').click(function (e) {
                if ($("#formGrades").valid()) {

                    if(   $('#btnSaveGrd').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType = 'update';
                    }

                    f = new FormData($("#formGrades")[0]);
                    f.append('formType',$formType);

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
                                    // close_modal();
                                    table.ajax.reload();
                                    clear_form();
                                }

                            })
                        }else if(response.type === 2){

                            Swal.fire({
                                title: '<strong>Grade Updated ! </strong>',
                                icon: 'success',
                                html: 'Grade updated successfully !',
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

            $('#btnSave').click(function (e) {
                if ($("#formSection").valid()) {

                    f = new FormData($("#formSection")[0]);
                    f.append('formType','save');

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('section.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Section Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Section Added ! </strong>',
                                icon: 'success',
                                html: 'Section added successfully !',
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

        var table = $('#gradesTable').DataTable({

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

                url: "{{route('grade.get')}}",
            },

            "columnDefs": [

            ]

        });

        // change default button action
        var defaultPDFAction = table.button(3).action();
        table.button(3).action(function (e, dt, button, config) {

            pdf();
        });

        function show_modal() {
            // alert('works');
            $('#modalSections').modal('show');
        }

        function close_modal(){
            $('#SecName').val("");
            get_active_sections();
            $('#modalSections').modal('hide');
            // swal.close();
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
                    text: 'Choose a Section...'
                }));
                $('#GrdSection2').empty().append($('<option>', {
                    value: " ",
                    text: 'All'
                }));
                $.each(response, function (i, item) {
                    $('#GrdSection').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));

                    $('#GrdSection2').append($('<option>', {
                        value: item.name,
                        text : item.name
                    }));
                });
            });
        }

        function edit_grade(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"grade.get_one/"+id,

            }).done(function (response) {
                console.log(response);
                $('#grdId').val(response.id);
                $('#GrdName').val(response.name);
                $('#GrdSection').val(response.section_id);




                $('#btnSaveGrd').text('Update');


            });
        }

        function toggle_grade(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"grade.toggle/"+id,

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
            $('#formGrades')[0].reset();
            $('#btnSaveGrd').text('Save');
        }

        $('#GrdSection2').change(function (){
            table.column(1).search($(this).val()).draw();
        });

        $('#GrdStatus').change(function (){
            table.column(2).search($(this).val()).draw();
        });
    </script>
@endsection
