@extends('driver.layouts.app')
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
                            <div class="card-body text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_report">Add Report</button>
                            </div>
                            <form action="{{ route('vehicles.update', $vehicle)}}" enctype="multipart/form-data" class="form-valide" method="POST">
                                @csrf @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Vehicle Name</label>
                                        <input type="text" readonly value="{{$vehicle->vehicle_name}}" name="vehicle_name" class="form-control" id="">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label>Driver</label>
                                        <input type="text" name="" readonly class="form-control" value="{{ucwords($vehicle->driver->lastname.' '.$vehicle->driver->firstname)}}" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <h5>Vehicle Details</h5>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Registration Number</label>
                                        <input type="text"  readonly value="{{$vehicle->reg_no}}" name="" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Type</label>
                                        <select disabled name="" class="form-control" id="">
                                            @foreach ($types as $item)
                                                <option {{($vehicle->type == $item) ? 'selected' : ''}}>{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Description</label>
                                        <input type="text" readonly value="{{$vehicle->description}}" name="" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Make</label>
                                        <input type="text" value="{{$vehicle->make}}" name="" readonly class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Model</label>
                                        <input type="text" value="{{$vehicle->model}}" name="" readonly class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Year</label>
                                        <input type="text" name="" value="{{$vehicle->year}}" readonly class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Condition</label>
                                        <input type="text" readonly  name="" value="{{$vehicle->condition}}" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status</label>
                                        <select disabled name="" class="form-control" id="">
                                            <option {{ $vehicle->status == 'Active' ? 'Selected' : '' }} value="Active">Active</option>
                                            <option {{ $vehicle->status == 'Inactive' ? 'Selected' : '' }} value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Category</label>
                                        <select disabled name="" class="form-control category" id="">
                                            <option  {{ $vehicle->category == 'Internal' ? 'Selected' : '' }} value="Internal">Internal</option>
                                            <option {{ $vehicle->category == 'External' ? 'Selected' : '' }} value="External">External</option>
                                        </select>
                                    </div>
                                    <div id="amount" class="form-group  {{ $vehicle->category == 'Internal' ? 'd-none' : '' }} col-md-6">
                                        <label>Amount</label>
                                        <input type="number" min="0" readonly name=""  value="{{$vehicle->amount}}" class="form-control" id="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Memo</h4>
                                <div id="activity">
                                    @foreach ($memos as $item)
                                        <div class="media border-bottom-1 pt-3 pb-3">
                                            <div class="media-body">
                                                <p class="mb-0">{{$item->memo}}</p>
                                            </div><span class="text-muted ">{{$item->created_at->toDayDateTimeString()}}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Vehicle Reports</h4>
                                <div id="activity">
                                    @foreach ($reports as $item)
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                        <div class="media-body">
                                            <h5>{{$item->description}}</h5>
                                            <p class="mb-0">By: {{$item->user->firstname.' '.$item->user->lastname}}</p>
                                            <p class="mb-0">Comment: {{$item->comments ?? 'None'}}</p>
                                        </div><span class="text-muted ">{{$item->created_at->toDayDateTimeString()}}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="bootstrap-modal">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="add_report">
                    <div class="modal-dialog " role="document">
                        <form action="{{ route('report.store') }}" enctype="multipart/form-data" class="form-valide" method="POST">
                            @csrf @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADD REPORT</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Category</label>
                                                <input type="text" readonly value="Vehicle" class="form-control" name="category">
                                                <input type="hidden" name="reference_id" value="{{$vehicle->id}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Description</label>
                                                <textarea class="form-control" rows="3" id="" name="description" placeholder="Description"> </textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
    <script>
    </script>
@endsection
