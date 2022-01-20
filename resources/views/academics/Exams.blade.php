@extends('layouts.admin')

@section('page_title')
    Exams & Results
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('exams')}}"> Exams & Results</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->

        <!-- /.card -->

        <div class="card card-dark  ">
            <div class="card-header p-2">
                <ul class="nav nav-tabs" id="examsTabs">
                    <li class="nav-item"><a class="nav-link active" href="#terms" data-toggle="tab">Exams</a></li>
                    <li class="nav-item"><a class="nav-link" href="#years" data-toggle="tab">Results</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body ">
                <div class="tab-content">
                    <div class="active tab-pane" id="terms">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Add Exam</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="formExam">
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="hidden" id="ExamId" name="ExamId">
                                            <div class="form-group">
                                                <label for="ExamType">Exam Type</label>
                                                <select class="form-control" id="ExamType" name="ExamType">
                                                    <option value="">Choose a Type...</option>
                                                    <option value="T">Term Test</option>
                                                    <option value="E">Other Exam</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="ExamName">Exam Name</label>
                                                <input type="text" class="form-control" name="ExamName" id="ExamName">

                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="ExamGrade">Subjects (Relevant Grade)</label>
                                                <select class="form-control" id="ExamGrade" name="ExamGrade">
                                                    <option value="">Choose a Grade...</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-default" onclick="clear_form('term')">Clear</button>
                                    <button type="button" id="btnSaveExam" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>

                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Manage Exams</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ExamType2">Exam Type</label>
                                            <select class="form-control" id="ExamType2" name="ExamType2">
                                                <option value=" ">All</option>
                                                <option value="Term Test">Term Test</option>
                                                <option value="Other Exam">Other Exam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ClsStatus">Status</label>
                                            <select class="form-control" id="ExamStatus" name="ExamStatus">
                                                <option value=" ">All</option>
                                                <option value="Active">Active</option>
                                                <option value="Deactivated">Deactivated</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <table id="examTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>Exam Type</th>
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
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="years">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Add Year</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="formYear">
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <div class="form-group">
                                                <div class="input-group date" id="yearName" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#yearName" name="yearName"/>
                                                    <div class="input-group-append" data-target="#yearName" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-default" onclick="clear_form('year')">Clear</button>
                                    <button type="button" id="btnSaveYer" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>

                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Manage Years</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ClsStatus">Status</label>
                                            <select class="form-control" id="yearStatus" name="yearStatus">
                                                <option value=" ">All</option>
                                                <option value="Active">Active</option>
                                                <option value="Deactivated">Deactivated</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <table id="yearTable" class="table table-bordered table-hover" style="width: 100%">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Year</th>
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
                    </div>
                    <!-- /.tab-pane -->


                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function () {

            get_active_grades();

            $('#formExam').validate({
                rules: {
                    ExamName: {
                        required: true,
                    },
                    ExamType: {
                        required: true,
                    },
                    ExamGrade: {
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

            $('#formTerm').validate({
                rules: {
                    TermName: {
                        required: true,
                    } ,

                    TermYear: {
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

            $('#btnSaveExam').click(function (e) {
                if ($("#formExam").valid()) {

                    if(   $('#btnSaveExam').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType = 'update';
                    }

                    f = new FormData($("#formExam")[0]);
                    f.append('formType',$formType);

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('exam.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Exam Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Exam Added ! </strong>',
                                icon: 'success',
                                html: 'Exam added successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    table.ajax.reload();
                                    clear_form('year');
                                }

                            })
                        }else if(response.type === 2){

                            Swal.fire({
                                title: '<strong>Exam Updated ! </strong>',
                                icon: 'success',
                                html: 'Exam updated successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    table.ajax.reload();
                                    clear_form();
                                }

                            })
                        }

                    });
                }
            });

            $('#btnSaveTerm').click(function (e) {
                if ($("#formTerm").valid()) {

                    if(   $('#btnSaveTerm').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType = 'update';
                    }

                    f = new FormData($("#formTerm")[0]);
                    f.append('formType',$formType);

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('term.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Term Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Term Added ! </strong>',
                                icon: 'success',
                                html: 'Term added successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    table2.ajax.reload();
                                    clear_form('term');
                                }

                            })
                        }else if(response.type === 2){

                            Swal.fire({
                                title: '<strong>Term Updated ! </strong>',
                                icon: 'success',
                                html: 'Term updated successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    table2.ajax.reload();
                                    clear_form('term');
                                }

                            })
                        }

                    });
                }
            });

            $('#termTabs a[href="#terms"]').on('click', function (e) {
                get_active_years();
            });

            $('#ExamType').change(function () {
                if ($(this).val()=='T'){
                    $('#ExamGrade').val('N/A');
                    $('#ExamGrade').css('pointer-events','none');
                }else {
                    $('#ExamGrade').val('');
                    $('#ExamGrade').css('pointer-events','auto');
                }
            })

        });


        var table = $('#examTable').DataTable({

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

                url: "{{route('exam.get')}}",
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

        var table2 = $('#termTable').DataTable({

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

                url: "{{route('term.get')}}",
            },

            "columnDefs": [
                { "width": "25%", "targets": 0 },
                { "width": "25%", "targets": 1 },
                { "width": "25%", "targets": 2 },
                { "width": "25%", "targets": 3 }
            ]

        });

        // change default button action
        var defaultPDFAction = table2.button(3).action();
        table.button(3).action(function (e, dt, button, config) {

            pdf();
        });

        function toggle_exam(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"exam.toggle/"+id,

            }).done(function (response) {
                if(response.type === 1){

                    table.ajax.reload();
                }


            });
        }

        function toggle_term(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"term.toggle/"+id,

            }).done(function (response) {
                if(response.type === 1){

                    table2.ajax.reload();
                }


            });
        }

        function edit_exam(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"exam.get_one/"+id,

            }).done(function (response) {
                // console.log(response);
                $('#ExamId').val(response.id);
                $('#ExamType').val(response.type);
                $('#ExamName').val(response.name);
                $('#ExamGrade').val(response.subjects);

                $('#btnSaveExam').text('Update');


            });
        }

        function clear_form(){

         $('#formExam')[0].reset();
            $('#btnSaveExam').text('Save');

        }

        function get_active_grades(){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"grade.get_active",

            }).done(function (response) {
                $('#ExamGrade').empty().append($('<option>',
                    {
                    value: "",
                    text: 'Choose a Grade...'
                    }
                ));
                $('#ExamGrade').append($('<option>',
                    {
                        value: "N/A",
                        text: 'N/A'
                    }
                ));

                $.each(response, function (i, item) {
                    $('#ExamGrade').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));
                });
            });
        }

        $('#ExamType2').change(function (){
            table.column(1).search($(this).val()).draw();
        });

        $('#ExamStatus').change(function (){
            table.column(2).search($(this).val()).draw();
        });

        $('#TrmYear2').change(function (){
            table2.column(1).search($(this).val()).draw();
        });

        $('#TermStatus').change(function (){
            table2.column(2).search($(this).val()).draw();
        });



    </script>
@endsection
