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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Orders</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Orders</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Reference</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
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
                                                {{ucfirst($item->user->lastname ?? $item->lastname)}} {{ucfirst($item->user->firstname ?? $item->firstname)}}
                                            </td>
                                            <td>
                                                {{$item->user->email ?? $item->email}}
                                            </td>
                                            <td>
                                                {{$item->user->phone ?? $item->phone}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'Pending')
                                                    <i class="fa fa-circle-o text-warning  mr-2"></i> {{$item->status}}
                                                @else
                                                    <i class="fa fa-circle-o text-success  mr-2"></i>  {{$item->status}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->order_detail == null)
                                                    <i class="fa fa-circle-o text-warning  mr-2"></i> Process Pending
                                                @else
                                                    <i class="fa fa-circle-o text-success  mr-2"></i>  Processed
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <form action="{{ route('orders.destroy', $item)}}" method="post">@csrf @method('delete')
                                                    <span>
                                                        <a class="btn btn-info btn-sm mx-2" href="{{ route('orders.show', $item) }}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-info color-muted mr-1"></i>View</a>
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
        })
    </script>
@endsection
