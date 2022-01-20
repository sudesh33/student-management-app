@extends('layouts.admin')

@section('page_title')
    Terms & Years
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('termandyear')}}"> Terms & Years</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->

        <!-- /.card -->

        <div class="card card-dark  ">
            <div class="card-header p-2">
                <ul class="nav nav-tabs" id="termTabs">
                    <li class="nav-item"><a class="nav-link active" href="#terms" data-toggle="tab">Terms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#years" data-toggle="tab">Years</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body ">
                <div class="tab-content">
                    <div class="active tab-pane" id="terms">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Add Term</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="formTerm">
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="hidden" id="TermId" name="TermId">
                                            <div class="form-group">
                                                <label for="TermName">Term Name</label>
                                                <select class="form-control" id="TermName" name="TermName">
                                                    <option value="">Choose a Term...</option>
                                                    <option value="1">1 <sup>st</sup></option>
                                                    <option value="2">2 <sup>nd</sup></option>
                                                    <option value="3">3 <sup>rd</sup></option>
                                                </select>
                                            </div>


                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="TermYear">Year</label>
                                                <div class="input-group">
                                                    <select class="form-control" id="TermYear" name="TermYear">
                                                        <option value="">Choose a Term...</option>

                                                    </select>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-plus"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-right">
                                    <button type="button" class="btn btn-default" onclick="clear_form('term')">Clear</button>
                                    <button type="button" id="btnSaveTerm" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                        </div>

                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Manage Terms</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="TrmYear2">Year</label>
                                            <select class="form-control" id="TrmYear2" name="TrmYear2">
                                                <option value="">Choose a Term...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ClsStatus">Status</label>
                                            <select class="form-control" id="TermStatus" name="TermStatus">
                                                <option value=" ">All</option>
                                                <option value="Active">Active</option>
                                                <option value="Deactivated">Deactivated</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <table id="termTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Term</th>
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

            get_active_years();

            $('#yearName').datetimepicker({
                viewMode: 'years',
                format: 'YYYY',
            });

            $('#formYear').validate({
                rules: {
                    yearName: {
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

            $('#btnSaveYer').click(function (e) {
                if ($("#formYear").valid()) {

                    f = new FormData($("#formYear")[0]);

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('year.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Year Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Year Added ! </strong>',
                                icon: 'success',
                                html: 'Year added successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    table.ajax.reload();
                                    clear_form('year');
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

        });


        var table = $('#yearTable').DataTable({

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

                url: "{{route('year.get')}}",
            },

            "columnDefs": [
                { "width": "40%", "targets": 0 },
                { "width": "40%", "targets": 1 },
                { "width": "20%", "targets": 2 }
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

        function toggle_year(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"year.toggle/"+id,

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

        function edit_term(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"term.get_one/"+id,

            }).done(function (response) {
                // console.log(response);
                $('#TermId').val(response.id);
                $('#TermName').val(response.name);
                $('#TermYear').val(response.year_id);




                $('#btnSaveTerm').text('Update');


            });
        }

        function clear_form(form){
            if (form=='year'){
                $('#formYear')[0].reset();
            }else if (form=='term'){
                $('#formTerm')[0].reset();
            }
        }

        function get_active_years(){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"year.get_active",

            }).done(function (response) {
                $('#TermYear').empty().append($('<option>', {
                    value: "",
                    text: 'Choose a Year...'
                }));
                $('#TrmYear2').empty().append($('<option>', {
                    value: " ",
                    text: 'All'
                }));
                $.each(response, function (i, item) {
                    $('#TermYear').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));

                    $('#TrmYear2').append($('<option>', {
                        value: item.name,
                        text : item.name
                    }));
                });
            });
        }

        $('#yearStatus').change(function (){
            table.column(1).search($(this).val()).draw();
        });

        $('#TrmYear2').change(function (){
            table2.column(1).search($(this).val()).draw();
        });

        $('#TermStatus').change(function (){
            table2.column(2).search($(this).val()).draw();
        });



    </script>
@endsection
