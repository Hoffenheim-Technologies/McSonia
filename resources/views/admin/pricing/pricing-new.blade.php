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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Pricing New</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pricing.store')}}" enctype="multipart/form-data" class="form-valide" method="POST">
                                @csrf @method('POST')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Pickup Location</label>
                                        <select class="form-control" name="pickup_id" id="pickup_id">
                                            @foreach ($locations as $item)
                                                <option value="{{$item->id}}">{{$item->location}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label>Dropoff Location</label>
                                        <select class="form-control" name="dropoff_id" id="dropoff_id">
                                            @foreach ($locations as $item)
                                                <option value="{{$item->id}}">{{$item->location}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Price</label>
                                        <input type="number" min="0" placeholder="Price" class="form-control" name="price" value="{{old('price')}}" >
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
