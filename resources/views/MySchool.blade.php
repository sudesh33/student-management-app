@extends('layouts.admin')

@section('page_title')
    My School
@endsection

@section('page_breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('myschool')}}">School</a></li>
@endsection


@section('content')

    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">School Info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="formSchool">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">

                            <input type="hidden" id="SclId" name="SclId">
                            <div class="form-group">
                                <label for="AuditNumber">Audit Number</label>
                                <input type="text" name="AuditNumber" class="form-control" id="AuditNumber" placeholder="Enter Audit Number">
                            </div>
                            <div class="form-group">
                                <label for="SclName">Name</label>
                                <input type="text" name="SclName" class="form-control" id="SclName" placeholder="Enter School Name">
                            </div>
                            <div class="form-group">
                                <label for="SclType">Type</label>
                                <input type="text" name="SclType" class="form-control" id="SclType" placeholder="Enter School Name">
                            </div>
                            <div class="form-group">
                                <label for="GnDivision">Grama Niladari Divition</label>
                                <input type="text" name="GnDivision" class="form-control" id="GnDivision" placeholder="Enter Grama Niladari Divition">
                            </div>
                            <div class="form-group">
                                <label for="DsDivision">Divisional Secretory Division</label>
                                <input type="text" name="DsDivision" class="form-control" id="DsDivision" placeholder="Enter Secretory Division">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="SclDistrict">District</label>
                                <input type="text" name="SclDistrict" class="form-control" id="SclDistrict" placeholder="Enter District">
                            </div>
                            <div class="form-group">
                                <label for="SclProvince">Province</label>
                                <input type="text" name="SclProvince" class="form-control" id="SclProvince" placeholder="Enter Province">
                            </div>

                            <div class="form-group">
                                <label for="SclContact">Contact No.</label>
                                <input type="text" name="SclContact" class="form-control" id="SclContact" placeholder="Enter Contact Number">
                            </div>

                            <div class="form-group">
                                <label for="SclEmail">Email</label>
                                <input type="email" name="SclEmail" class="form-control" id="SclEmail" placeholder="Enter Email">
                            </div>


                        </div>
                    </div>



                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-default">Clear</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function (){

            get_school_info();

            $('#formSchool').validate({
                rules: {
                    AuditNumber: {
                        required: true,

                    },
                    SclName: {
                        required: true,

                    },
                    SclType: {
                        required: true,

                    },
                    GnDivision: {
                        required: true
                    },

                    DsDivision: {
                        required: true,

                    },
                    SclDistrict: {
                        required: true,

                    },
                    SclProvince: {
                        required: true
                    },

                    SclContact: {
                        required: true,

                    },
                    SclEmail: {

                        email:true,
                    },

                },
                messages: {
                    SclEmail: {

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
                if ($("#formSchool").valid()) {

                    if(   $('#btnSave').text()==="Save"){
                        $formType= 'save';
                    }else {
                        $formType= 'update';
                    }


                    f = new FormData($("#formSchool")[0]);
                    f.append('formType',$formType);

                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });

                    $.ajax({
                        type: "POST",
                        data: f,
                        processData: false,
                        contentType: false,
                        url: "{{route('school.create')}}",
                    }).done(function (response) {


                       if (response.type === 1){

                            Swal.fire({
                                title: '<strong>School Info Saved ! </strong>',
                                icon: 'success',
                                showCloseButton: true,
                                willClose: () => {
                                    get_school_info();
                                }

                            })
                        }else if(response.type === 2){
                           Swal.fire({
                               title: '<strong>School Info Updated ! </strong>',
                               icon: 'success',
                               showCloseButton: true,
                               willClose: () => {
                                   get_school_info();
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

        function get_school_info(){
            $.ajax({

                type: "GET",
                dataType:'json',
                processData: false,
                contentType: false,
                url:"school.get_school",

            }).done(function (response) {
                console.log(response);

                $('#SclId').val(response.id);
                $('#AuditNumber').val(response.audit_no);
                $('#SclDistrict').val(response.distric);
                $('#SclName').val(response.name);
                $('#SclProvince').val(response.pc);
                $('#SclType').val(response.type);
                $('#SclContact').val(response.contact);
                $('#GnDivision').val(response.gs_divition);
                $('#SclEmail').val(response.email);
                $('#DsDivision').val(response.ds_divition);

                $('#btnSave').text('Update');


            });
        }
    </script>
@endsection
