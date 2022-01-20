@extends('layouts.admin')

@section('page_title')
    Students Admission
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('studentAdmission')}}">Students Admission</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Students Admission</h3>
            </div>
            <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#personal-info">
                            <button type="button" class="step-trigger" role="tab" aria-controls="personal-info" id="personal-info-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Personal information</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#contact-info">
                            <button type="button" class="step-trigger" role="tab" aria-controls="contact-info" id="contact-info-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Contact Information</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#academic-info">
                            <button type="button" class="step-trigger" role="tab" aria-controls="academic-info" id="academic-info-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Academic Information</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- your steps content here -->
                        <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">



                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="ClsName">Registration Number</label>
                                            <input type="text" name="RegNumber" id="RegNumber" class="form-control"  >
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="ClsName">Name in Full</label>
                                        <input type="text" name="FullName" class="form-control" id="FullName" placeholder="Full Name">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="ClsName">Name with Initials</label>
                                        <input type="text" name="IntName" class="form-control" id="IntName" placeholder="Name with Initials">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ClsName">Date of Birth</label>
                                        <div class="input-group date" id="Dob" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#Dob" name="Dob"/>
                                            <div class="input-group-append" data-target="#Dob" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!-- checkbox -->
                                    <div class="form-group">
                                        <label for="ClsName">Gender</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="M"  name="Gender" checked>
                                            <label class="form-check-label">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="F" name="Gender">
                                            <label class="form-check-label">Female</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ClsStatus">Nationality</label>
                                        <select class="form-control" id="nationality" name="nationality">
                                            <option value="">Select..</option>
                                            <option value="S">Sinhala</option>
                                            <option value="T">Tamil</option>
                                            <option value="M">Muslim</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ClsStatus">Religion</label>
                                        <select class="form-control" id="yearStatus" name="yearStatus">
                                            <option value="">Select..</option>
                                            <option value="B">Buddhist</option>
                                            <option value="C">Catholic</option>
                                            <option value="H">Hindu</option>
                                            <option value="I">Islam</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ClsStatus">Transport Mode</label>
                                        <select class="form-control" id="transportMode" name="transportMode">
                                            <option value="">Select..</option>
                                            <option value="B">Bus</option>
                                            <option value="S">School Van</option>
                                            <option value="P">Privet Vehicle</option>
                                            <option value="F">Foot</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ClsName">Distance To School</label>
                                        <input type="text" name="distance" id="distance" class="form-control"  >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ClsName">Health Issues</label>
                                        <input type="text" name="health" id="health" class="form-control" data-role="tagsinput" >
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="image" class="control-label">Photo</label>
                                                    <div>

                                                        <img class="img-circle" id="profile_picture" height="128"
                                                             data-holder-rendered="true"
                                                             style="width: 140px; height: 140px;border: solid;color:#545759;padding: 2px; cursor: pointer;"/>
                                                        <span class="pencil glyphicon glyphicon-pencil"   style="display : none;"></span>
                                                        <br><br>
                                                        </span>
                                                    </div>
                                                    <div id="profile_pic_modal" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-hidden="true">
                                                                        &times;
                                                                    </button>
                                                                    <h3>Change Profile Picture</h3>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="cropimage" method="post"
                                                                          enctype="multipart/form-data"
                                                                          action="students/save_pic">
                                                                        <strong>Upload Image:</strong> <br><br>
                                                                        <input type="file" name="profile-pic"
                                                                               id="profile-pic"/>
                                                                        <input type="hidden" name="hdn-profile-id"
                                                                               id="hdn-profile-id" value="1"/>
                                                                        <input type="hidden" name="hdn-x1-axis"
                                                                               id="hdn-x1-axis" value=""/>
                                                                        <input type="hidden" name="hdn-y1-axis"
                                                                               id="hdn-y1-axis" value=""/>
                                                                        <input type="hidden" name="hdn-x2-axis"
                                                                               value="" id="hdn-x2-axis"/>
                                                                        <input type="hidden" name="hdn-y2-axis"
                                                                               value="" id="hdn-y2-axis"/>
                                                                        <input type="hidden" name="hdn-thumb-width"
                                                                               id="hdn-thumb-width" value=""/>
                                                                        <input type="hidden" name="hdn-thumb-height"
                                                                               id="hdn-thumb-height" value=""/>
                                                                        <input type="hidden" name="action" value=""
                                                                               id="action"/>
                                                                        <input type="hidden" name="image_name"
                                                                               value="" id="image_name"/>

                                                                        <div id='preview-profile-pic'></div>
                                                                        <div id="thumbs"
                                                                             style="padding:5px; width:600px"></div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="button" id="save_crop"
                                                                            class="btn btn-primary">Crop & Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="text-right">
                                <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>

                        </div>
                        <div id="contact-info" class="content" role="tabpanel" aria-labelledby="contact-info-trigger">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>

                        </div>

                        <div id="academic-info" class="content" role="tabpanel" aria-labelledby="academic-info-trigger">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function (){

            window.stepper = new Stepper(document.querySelector('.bs-stepper'))

            $('#Dob').datetimepicker({
                // viewMode: 'years',
                format: 'YYYY-MM-DD',
                minDate: (moment().subtract(14, 'years')),
                maxDate: (moment().subtract(6, 'years')),
            });

            $('#RegNumber').inputmask('04121/99999', { 'placeholder': '04121/00001' });

            $('#distance').inputmask('99.99 KM', { 'placeholder': '01.25 KM' });

            $('#health').tagsinput({
                // maxTags: 3
            });

            $("#profile_picture").on('click', function () {

                jQuery('#profile_pic_modal').modal({show: true});


            });

            $('#profile-pic').on('change', function () {

                jQuery("#preview-profile-pic").html('');
                jQuery("#preview-profile-pic").html('Uploading....');
                jQuery("#cropimage").ajaxForm(
                    {
                        target: '#preview-profile-pic',
                        success: function () {
                            jQuery('img#photo').imgAreaSelect({
                                aspectRatio: '1:1',
                                onSelectEnd: getSizes,
                            });
                            jQuery('#image_name').val(jQuery('#photo').attr('file-name'));
                        }
                    }).submit();

            });

            get_active_grades();

            $('#formSubject').validate({
                rules: {
                    SubName: {
                        required: true,
                    },
                    SubGrade: {
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

            $('#btnSaveSub').click(function (e) {
                if ($("#formSubject").valid()) {

                    if(   $('#btnSaveSub').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType = 'update';
                    }

                    f = new FormData($("#formSubject")[0]);
                    f.append('formType',$formType);

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('subject.create')}}",
                    }).done(function (response) {

                        if (response.type === 0){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Exist',
                                text: 'Existing Subject Name !',


                            })

                        }else if(response.type === 1){

                            Swal.fire({
                                title: '<strong>Subject Added ! </strong>',
                                icon: 'success',
                                html: 'Subject added successfully !',
                                showCloseButton: true,
                                willClose: () => {
                                    // close_modal();
                                    table.ajax.reload();
                                    clear_form();
                                }

                            })
                        }else if(response.type === 2){

                            Swal.fire({
                                title: '<strong>Subject Updated ! </strong>',
                                icon: 'success',
                                html: 'Subject updated successfully !',
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

        var table = $('#subjectTable').DataTable({

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

                url: "{{route('subject.get')}}",
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
            get_active_sections();
            $('#modalGrades').modal('show');
        }

        function close_modal(){
            $('#GrdName').val("");
            get_active_grades();
            $('#modalGrades').modal('hide');
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

        function get_active_grades(){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"grade.get_active",

            }).done(function (response) {
                $('#SubGrade').empty().append($('<option>', {
                    value: "",
                    text: 'Choose a Grade...'
                }));
                $('#SubGrade2').empty().append($('<option>', {
                    value: " ",
                    text: 'All'
                }));
                $.each(response, function (i, item) {
                    $('#SubGrade').append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));

                    $('#SubGrade2').append($('<option>', {
                        value: item.name,
                        text : item.name
                    }));
                });
            });
        }

        function edit_subject(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"subject.get_one/"+id,

            }).done(function (response) {
                console.log(response);
                $('#subId').val(response.id);
                $('#SubName').val(response.name);
                $('#SubGrade').val(response.grade_id);




                $('#btnSaveSub').text('Update');


            });
        }

        function toggle_subject(id) {
            // alert('edit'+id);
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"subject.toggle/"+id,

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
            $('#formSubject')[0].reset();
            $('#btnSaveSub').text('Save');
        }
        $('#SubGrade2').change(function (){
            table.column(1).search($(this).val()).draw();
        });
    </script>
@endsection
