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
                                                {{$item->order->reference}}
                                            </td>
                                            <td>
                                                {{ucfirst($item->order->user->lastname ?? $item->order->lastname)}} {{ucfirst($item->order->user->firstname ?? $item->order->firstname)}}
                                            </td>
                                            <td>
                                                {{$item->order->user->email ?? $item->order->email}}
                                            </td>
                                            <td>
                                                {{$item->order->user->phone ?? $item->order->phone}}
                                            </td>
                                            <td>
                                                @if ($item->status == 'Pending')
                                                    <i class="fa fa-circle-o text-warning  mr-2"></i> {{$item->status}}
                                                @else
                                                    <i class="fa fa-circle-o text-success  mr-2"></i>  {{$item->status}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm mx-2" href="{{ route('order.show', $item->order) }}" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-info color-muted mr-1"></i>View</a>
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
