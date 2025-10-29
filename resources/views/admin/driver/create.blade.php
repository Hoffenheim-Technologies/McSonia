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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Driver</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Add Driver</h4>
                                <form action="{{ route('drivers.store') }}" enctype="multipart/form-data" class="form-valide" method="POST">
                                    @csrf @method('POST')
                                    <div class="form-group">
                                        <div class="input-group col-md-7">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="photo" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>FirstName</label>
                                            <input type="text" class="form-control" value="{{old('firstname')}}" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>LastName</label>
                                            <input type="text" class="form-control" value="{{old('lastname')}}" name="lastname" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="val-email" name="email" value="{{old('email')}}" placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" id="val-address" name="address" value="{{old('address')}}" placeholder="1234 Main St">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Profile Summary</label>
                                            <input type="text" class="form-control" name="summary" value="{{old('summary')}}" placeholder="Summary">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" id="val-phoneus" value="{{old('phone')}}" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary px-3 ml-4">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
@section('custom-script')
    <script src="{{ $admin_source }}/plugins/validation/jquery.validate.min.js"></script>
    <script src="{{ $admin_source }}/plugins/validation/jquery.validate-init.js"></script>
@endsection
