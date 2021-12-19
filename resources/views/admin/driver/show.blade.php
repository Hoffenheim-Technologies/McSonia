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
                                <h4 class="card-title">Driver {{$user->firstname}}</h4>
                                <form action="{{ route('drivers.update', $user->id) }}" enctype="multipart/form-data" class="form-valide" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-group">
                                        <div class="input-group col-md-7">
                                            <div class="bootstrap-media">
                                                <div class="media">
                                                    <img class="mr-3 img-fluid" src="{{$user->image}}" alt="{{$user->firstname}} image">
                                                </div>
                                            </div>
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
                                            <input type="firstname" class="form-control"  value="{{$user->firstname}}" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>LastName</label>
                                            <input type="lastname" class="form-control"  value="{{$user->lastname}}" name="lastname" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="val-email" value="{{$user->email}}" readonly placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" id="val-address" name="address" value="{{$user->address}}" placeholder="1234 Main St">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Profile Summary</label>
                                            <input type="text" class="form-control" name="summary" value="{{$user->summary}}" placeholder="Summary">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" id="val-phoneus" value="{{$user->phone}}" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary px-3 ml-4">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">

                        <div class="card">
                            <div class="card-body">
                                <h4>Vehicles Managing</h4>
                                <div class="basic-list-group">
                                    <ul class="list-group">
                                        @foreach ($vehicles as $item)
                                            <li class="list-group-item">
                                             {{$loop->iteration}}. <a href="{{ route('vehicles.show', $item) }}">{{$item->vehicle_name}} - {{$item->reg_no}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ucwords($user->firstname)}} Orders</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Reference</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$item->reference}}
                                                </td>
                                                <td>
                                                    {{ucwords($item->lastname.' '.$item->firstname)}}
                                                </td>
                                                <td>
                                                    {{$item->email}}
                                                </td>
                                                <td>
                                                    {{$item->phone}}
                                                </td>
                                                <td>
                                                    {{-- <td class="" >
                                                        <span class="{{ $item->status == 1 ? 'label gradient-1' : 'label gradient-2'}} "> {{$item->status == 1 ? 'Active' : 'Inactive'}} </span>
                                                    </td>
                                                     --}}
                                                </td>
                                                <th>
                                                    {{$item->created_at}}
                                                </th>
                                                <td>
                                                    <form action="{{ route('order.destroy', $item)}}" method="post">@csrf @method('delete')
                                                        <span>
                                                            <a class="btn btn-info btn-sm mx-2" href="{{ route('order.show', $item) }}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-info color-muted mr-1"></i>View</a>
                                                            <button type="submit" class="btn btn-danger btn-sm mx-2" onsubmit="checkDelete(this)" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i> Delete</button>
                                                        </span>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="admins/plugins/validation/jquery.validate.min.js"></script>
    <script src="admins/plugins/validation/jquery.validate-init.js"></script>
@endsection
