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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Vehicles</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Vehicle Information</h4>
                            <form action="{{ route('vehicles.update', $vehicle)}}" enctype="multipart/form-data" class="form-valide" method="POST">
                                @csrf @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Vehicle Name</label>
                                        <input type="text" name="vehicle_name" class="form-control" id="">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label>Driver</label>
                                        <select class="form-control" name="user_id" id="">
                                            @foreach ($drivers as $item)
                                                <option {{($item->user_id == $vehicle->driver->id) ? 'selected' : ''}} value="{{$item->id}}">{{ucwords($item->lastname.' '.$item->firstname)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <h5>Vehicle Details</h5>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Registration Number</label>
                                        <input type="text" name="reg_no" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Type</label>
                                        <select name="type" class="form-control" id="">
                                            @foreach ($types as $item)
                                                <option {{($vehicle->type == $item) ? 'selected' : ''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Make</label>
                                        <input type="text" name="make" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Model</label>
                                        <input type="text" name="model" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Year</label>
                                        <input type="text" name="year" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Condition</label>
                                        <input type="text" name="condition" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label></label>

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
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
@section('custom-script')
    <script src="{{ $admin_source }}/plugins/validation/jquery.validate.min.js"></script>
    <script src="{{ $admin_source }}/plugins/validation/jquery.validate-init.js"></script>
@endsection
