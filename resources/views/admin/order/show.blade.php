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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order</a></li>
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

                            <div class="basic-list-group">
                                <div class="row">
                                    <div class="col-xl-4 col-md-4 col-sm-3 mb-4 mb-sm-0">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <a class="list-group-item list-group-item-action active" id="list-one-list"
                                            data-toggle="list" href="#list-one" role="tab" aria-controls="one">Client Info</a>
                                            <a class="list-group-item list-group-item-action" id="list-two-list"
                                                data-toggle="list" href="#list-two" role="tab" aria-controls="two">Order Info</a>
                                                <a class="list-group-item list-group-item-action" id="list-three-list" data-toggle="list" href="#list-three" role="tab"
                                                aria-controls="three">Driver Info</a>

                                        </div>
                                    </div>
                                    <div class="col-xl-8 col-md-8 col-sm-9">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="list-one">
                                                <p>
                                                    Reference: {{$order->reference}}
                                                </p>
                                                <p>
                                                    Name: {{ucfirst($order->user->lastname ?? $order->lastname)}} {{ucfirst($order->user->firstname ?? $order->firstname)}}
                                                </p>
                                                <p>
                                                    Phone: <a href="tel:+{{$order->user->phone ?? $order->phone}}">{{$order->user->phone ?? $order->phone}}</a>
                                                </p>
                                                <p>
                                                    Email: <a href="mailto:{{$order->user->email ?? $order->email}}">{{$order->user->email ?? $order->email}}</a>
                                                </p>
                                                <p>
                                                    Company: {{$order->company}}
                                                </p>

                                            </div>
                                            <div class="tab-pane fade" id="list-two" role="tabpanel">
                                                <p>
                                                    Reference: {{$order->reference}}
                                                </p>
                                                <p>
                                                    Pickup Location: {{($order->plocation->location) ?? ' ' }}
                                                </p>
                                                <p>
                                                    Pickup Address: {{$order->paddress}}
                                                </p>
                                                <p>
                                                    Pickup Time: {{$order->pdate.' '.$order->ptime}}
                                                </p>
                                                <p>
                                                    Dropoff Location: {{($order->dlocation->location) ?? ' ' }}
                                                </p>
                                                <p>
                                                    Dropoff Address: {{$order->daddress}}
                                                </p>
                                                <p>
                                                    Discount: @money($order->discount)
                                                </p>
                                                <p>
                                                    Sub Total: @money($order->subtotal)
                                                </p>
                                                <p>
                                                    Total: @money($order->total)
                                                </p>
                                                <p>
                                                    Status: <span class="badge {{$order->status != 'Pending' ? 'badge-primary' : 'badge-warning text-white'}} px-2">{{$order->status}}</span>
                                                </p>

                                            </div>
                                            <div class="tab-pane fade" id="list-three" role="tabpanel">
                                                @if ($orderDetail)
                                                    <p>Reference: {{$order->reference}}</p>
                                                    <p>
                                                        Driver: {{ucwords($orderDetail->driver->lastname ?? '')}} {{ucwords($orderDetail->driver->firstname ?? '')}}
                                                    </p>
                                                    <p>
                                                            Status: <span class="badge {{$orderDetail->status != 'Pending' ? 'badge-primary' : 'badge-warning text-white'}} px-2">{{$orderDetail->status}}</span>

                                                    </p>
                                                @else
                                                    <h4>Not Assigned</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- #/ container -->



            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (empty($orderDetail))
                                    <h5> Assign Driver</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Name</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Vehicle Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($drivers as $item)
                                                <tr>
                                                    <td>
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td>
                                                        {{ucwords($item->lastname.' '.$item->firstname)}}
                                                    </td>
                                                    <td>
                                                        {{$item->vehicle->type ?? ''}}
                                                    </td>
                                                    <td>
                                                        {{$item->vehicle->vehicle_name ?? ''}}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('order.assign', ['driver'=>$item, 'order'=>$order])}}" method="post">@csrf @method('POST')
                                                            <span class="">
                                                                <button type="submit" class="btn btn-success confirm-btn btn-sm mx-2" data-toggle="tooltip" data-placement="top" title="Assign"><i class="fa fa-check color-success"></i> Assign</button>
                                                            </span>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                <h4 class="card-title">Order Progress</h4>
                                    <div class="">
                                        <h4><span class="badge {{$orderDetail->status != 'Pending' ? 'badge-primary' : 'badge-warning text-white'}} px-2">{{$orderDetail->status}}</span></h4>
                                    </div>
                                    <div class="progress" style="height: 15px;">
                                        <div class="progress-bar {{($orderDetail->statusNo <= 0) ? 'bg-inverse' : ($orderDetail->statusNo <= 10) ? 'bg-danger' : ($orderDetail->statusNo <= 50) ? 'bg-info' : 'bg-success' }}" style="width: {{$orderDetail->statusNo}}%;" role="progressbar"><span class="">{{$orderDetail->statusNo}}% Complete</span>
                                        </div>
                                    </div>
                                @endif
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
    <script>
        $('.confirm-btn').on('click',function(e){

            e.preventDefault();

            var form = $(this).parents('form:first');
            swal({title:"Are you sure ?",
                text:"Do you want to perform this action? !!",
                type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",
                confirmButtonText:"Yes !!",cancelButtonText:"No, cancel it !!",
                closeOnConfirm:1,closeOnCancel:1},
                function(e){
                    if(e)
                        $(form).submit();
                }
            )
        });
    </script>
@endsection
