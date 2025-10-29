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

            <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Vehicles</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Driver Assigned</th>
                                            <th>Type</th>
                                            <th>Reg No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $item)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$item->vehicle_name}}
                                            </td>
                                            <td>
                                               <a href="{{route('drivers.show', $item->driver->id)}}">
                                                    {{$item->driver->lastname ?? ''}} {{$item->driver->firstname ?? ''}}
                                                </a>
                                            </td>
                                            <td>
                                                {{$item->type}} 
                                            </td>
                                            <td>
                                                {{$item->reg_no}}
                                            </td>
                                            <td>
                                                <span class="{{ $item->status == 'Inactive' ? 'label gradient-2' : 'label gradient-1'}} "> {{$item->status}} </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('vehicles.destroy', $item)}}" method="post">@csrf @method('delete')
                                                    <span>
                                                        <a class="btn btn-info btn-sm mx-2" href="{{ route('vehicles.show', $item) }}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-info color-muted mr-1"></i>View</a>
                                                        <button type="submit" class="btn btn-danger delete-btn btn-sm mx-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close color-danger"></i> Delete</button>
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
        $('.delete-btn').on('click',function(e){
                    e.preventDefault();

                    var form = $(this).parents('form:first');
                    swal({
                            title:"Are you sure to delete ?",
                            text:"You will not be able to recover this data !!",
                            type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",
                            confirmButtonText:"Yes, delete it !!",closeOnConfirm:1},
                            function(e){
                                if(e)
                                    $(form).submit();
                            }
                        )
                });
    </script>
@endsection
