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
                            <h4 class="card-title">Add Vehicle</h4>
                            <form action="{{ route('vehicles.store')}}" enctype="multipart/form-data" class="form-valide" method="POST">
                                @csrf @method('POST')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Vehicle Name</label>
                                        <input type="text"  value="{{old('vehicle_name')}}" name="vehicle_name" class="form-control" id="">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label>Driver</label>
                                        <select class="form-control" name="user_id" id="">
                                            @foreach ($drivers as $item)
                                                <option value="{{$item->id}}">{{ucwords($item->lastname.' '.$item->firstname)}}</option>
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
                                        <input type="text"  value="{{old('reg_no')}}" name="reg_no" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Type</label>
                                        <select name="type" class="form-control" id="">
                                            @foreach ($types as $item)
                                                <option>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Model</label>
                                        <input type="text"  value="{{old('model')}}" name="model" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Year</label>
                                        <input type="text" name="year"  value="{{old('year')}}" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Condition</label>
                                        <input type="text" name="condition"  value="{{old('condition')}}" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control" id="">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Category</label>
                                        <select name="category" class="form-control category" id="">
                                            <option selected value="Internal">Internal</option>
                                            <option value="External">External</option>
                                        </select>
                                    </div>
                                    <div id="amount" class="form-group col-md-6">
                                        <label>Amount</label>
                                        <input type="text" name="amount"  value="{{old('amount')}}" class="form-control" id="">
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
    <script>
        $('#amount').css('display','none');
        $(document).on('change keyup', ".category", function() {
            $('#amount').slideToggle();
        });
    </script>
@endsection
