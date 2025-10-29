@extends('admin.layouts.app')
@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">CHange Password</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-header">

                                <h3>Change Password</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.changePassword') }}" enctype="multipart/form-data" class="form-valide" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Old Password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>New Password</label>
                                            <input type="password" class="check_password form-control" id="new_password"  name="new_password" placeholder="New Password">
                                            <span class="m-1" id="cr_1"></span> <br>
                                            <span class="m-1" id="cr_2"></span> <br>
                                            <span class="m-1" id="cr_3"></span> <br>
                                            <span class="m-1" id="cr_4"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Confirm New Password</label>
                                            <input type="password" class="check_password form-control" id="conf_new_password" name="conf_new_password" placeholder="New Password">
                                            <span class="m-2" id="conf_new_password_span"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary confirm-btn px-3 ml-4">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
@section('custom-script')
    <script src="{{ $admin_source }}/plugins/validation/jquery.validate.min.js"></script>
    <script src="{{ $admin_source }}/plugins/validation/jquery.validate-init.js"></script>
    <script>
        var count = 0;

        $('.confirm-btn').on('click',function(e){
            e.preventDefault();

            var form = $(this).parents('form:first');
            swal({title:"Are you sure ?",
                text:"Do you want to perform this action? !!",
                type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",
                confirmButtonText:"Yes !!",cancelButtonText:"No, cancel it !!",
                closeOnConfirm:1,closeOnCancel:1},
                function(e){
                    if(e&&count==5){
                        $(form).submit();
                    }else{
                        toastr.error('Password Does Not Meet Criteria')
                    }
                }
            )
        });

        $(document).on('change keyup','.check_password', function(){
            count = 0;
            var pass_new = $('#new_password').val();
            $('#cr_1').html('Password Must Have At Least 1 Number')
            $('#cr_2').html('Password Must Have At Least 6 Characters. No Spaces allowed')
            $('#cr_3').html('Password Must Have At One Uppercase Letter')
            $('#cr_4').html('Password Must Have At One Lowercase Letter')
            if(/\d/.test(pass_new)){
                count++;
                $('#cr_1').removeClass('text-danger');
                $('#cr_1').addClass('text-success');
            }else{
                $('#cr_1').addClass('text-danger');
                $('#cr_1').removeClass('text-success');
            }if(pass_new.match(/^([a-zA-Z0-9]{6,})$/)){
                count++;
                $('#cr_2').removeClass('text-danger');
                $('#cr_2').addClass('text-success');
            }else{
                $('#cr_2').addClass('text-danger');
                $('#cr_2').removeClass('text-success');
            }
            if(/[A-Z]/.test(pass_new)){
                count++;
                $('#cr_3').removeClass('text-danger');
                $('#cr_3').addClass('text-success');
            }else{
                $('#cr_3').addClass('text-danger');
                $('#cr_3').removeClass('text-success');
            }
            if(/[a-z]/.test(pass_new)){
                count++;
                $('#cr_4').removeClass('text-danger');
                $('#cr_4').addClass('text-success');
            }else{
                $('#cr_4').addClass('text-danger');
                $('#cr_4').removeClass('text-success');
            }
            var conf_new = $('#conf_new_password').val();
            if(pass_new === conf_new){
                count++;
                $('#conf_new_password_span').removeClass('text-danger');
                $('#conf_new_password_span').addClass('text-success');
                $('#conf_new_password_span').html('Password Match!');
            }else{
                $('#conf_new_password_span').removeClass('text-success');
                $('#conf_new_password_span').addClass('text-danger');
                $('#conf_new_password_span').html('Password Mismatch!');
            }
        });

    </script>
@endsection
