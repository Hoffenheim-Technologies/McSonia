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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Locations New</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                        <div class="card-body">
                            <form action="{{ route('locations.store')}}" enctype="multipart/form-data" class="form-valide" method="POST">
                                @csrf @method('POST')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Pickup Location</label>
                                        <input type="text" class="form-control" value="{{old('pickup')}}" name="pickup" placeholder="Pickup Location">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Delivery Location</label>
                                        <input type="text" class="form-control" value="{{old('destination')}}" name="destination" placeholder="Delivery location">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Amount</label>
                                        <input type="number" min="0" placeholder="Amount" class="form-control" name="amount" value="{{old('amount')}}" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control" id="">
                                            <option selected value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary px-3 ml-4">Create</button>
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
