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
                                        <input type="text" value="{{$vehicle->vehicle_name}}" name="vehicle_name" class="form-control" id="">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label>Driver</label>
                                        <select class="form-control" name="user_id" id="">
                                            @foreach ($drivers as $item)
                                                <option {{($item->id == $vehicle->driver->id) ? 'selected' : ''}} value="{{$item->id}}">{{ucwords($item->lastname.' '.$item->firstname)}}</option>
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
                                        <input type="text" value="{{$vehicle->reg_no}}" name="reg_no" class="form-control" id="">

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
                                        <input type="text" value="{{$vehicle->description}}" name="description" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Make</label>
                                        <input type="text" value="{{$vehicle->make}}" name="make" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Model</label>
                                        <input type="text" value="{{$vehicle->model}}" name="model" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Year</label>
                                        <input type="text" name="year" value="{{$vehicle->year}}" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Condition</label>
                                        <input type="text" name="condition" value="{{$vehicle->condition}}" class="form-control" id="">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control" id="">
                                            <option {{ $vehicle->status == 'Active' ? 'Selected' : '' }} value="Active">Active</option>
                                            <option {{ $vehicle->status == 'Inactive' ? 'Selected' : '' }} value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Category</label>
                                        <select name="category" class="form-control category" id="">
                                            <option  {{ $vehicle->category == 'Internal' ? 'Selected' : '' }} value="Internal">Internal</option>
                                            <option {{ $vehicle->category == 'External' ? 'Selected' : '' }} value="External">External</option>
                                        </select>
                                    </div>
                                    <div id="amount" class="form-group  {{ $vehicle->category == 'Internal' ? 'd-none' : '' }} col-md-6">
                                        <label>Amount</label>
                                        <input type="number" min="0" name="amount"  value="{{$vehicle->amount}}" class="form-control" id="">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary px-3 ml-4">Update</button>
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
                                <form class="" action="{{route('vehicles.storeMemo',$vehicle)}}" method="post">
                                    @csrf @method('POST')
                                    <div class="form-row">
                                        <div class="form-group col-7">
                                            <textarea name="memo" placeholder="Memo" class="form-control" cols="20" rows="3" id=""> </textarea>
                                        </div>
                                        <div class="form-group align-items-center col-4">
                                            <button type="submit" class="btn btn-primary px-3 ml-4">Submit</button>
                                        </div>

                                    </div>
                                </form>
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
                                    @if ($item->comments == null)
                                        <form action="{{route('reports.update', $item)}}" method="post">
                                            @csrf @method('PUT')
                                            <div class="form-row">
                                                <div class="form-group col-md-10">
                                                    <label>Add Comment</label>
                                                    <textarea class="form-control" rows="3" id="" name="comments" placeholder="Comment"> </textarea>
                                                </div>
                                                <div class="form-group col-md-10">
                                                    <input type="submit"  class="btn btn-primary" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    @endforeach
                                </div>
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
        $(document).on('change keyup', ".category", function() {
            var toggle = $(this).val()
            switch (toggle) {
                case 'Internal':
                    $('#amount').addClass('d-none');
                    break;
                case 'External':
                    $('#amount').removeClass('d-none');
                    break;
                default:
                    $('#amount').addClass('d-none');
                    break;
            }
        });
    </script>
@endsection
