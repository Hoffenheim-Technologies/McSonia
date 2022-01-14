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
                                <h4 class="card-title">Order Progress</h4>
                                    <div class="">
                                        <h4><span class="badge {{$orderDetail->status != 'Pending' ? 'badge-primary' : 'badge-warning text-white'}} px-2">{{$orderDetail->status}}</span></h4>
                                    </div>
                                    <div class="progress" style="height: 15px;">
                                        <div class="progress-bar {{($orderDetail->statusNo <= 0) ? 'bg-inverse' : ($orderDetail->statusNo <= 10) ? 'bg-danger' : ($orderDetail->statusNo <= 50) ? 'bg-info' : 'bg-success' }}" style="width: {{($orderDetail->statusNo > 0) ? $orderDetail->statusNo: '0'}}%;" role="progressbar"><span class="{{($orderDetail->statusNo <= 0) ? 'text-dark' : '' }} ">{{($orderDetail->statusNo > 0) ? $orderDetail->statusNo: '0' }}% Complete</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Update Status</h4>
                                <form action="{{route('order.update', $orderDetail)}}" method="POST">
                                    @csrf @method('PUT')
                                    @if ($orderDetail->status == 'Awaiting Pickup By Driver' || $orderDetail->status == 'Pending')
                                    <div class="general-button">
                                        <input type="submit" name="status" value="On Route To Deliver" class="btn mb-1 btn-primary">
                                    </div>
                                    @endif
                                    @if ($orderDetail->status == 'On Route To Deliver')
                                    <div class="general-button">
                                        <input type="submit" name="status" value="Back To Sender" class="btn mb-1 btn-warning">
                                        <input type="submit" name="status" value="Delivered" class="btn mb-1 btn-info">
                                    </div>
                                    @endif
                                    @if ($orderDetail->status == 'Delivered')
                                    <div class="general-button">
                                        <input type="submit" name="status" value="Back To Sender" class="btn mb-1 btn-secondary">
                                        <input type="submit" name="status" value="Cancel" class="btn mb-1 btn-danger">
                                        <input type="submit" name="status" value="Completed" class="btn mb-1 btn-success">
                                    </div>
                                    @endif
                                    @if ($orderDetail->status == 'Completed')
                                    <div class="general-submit">
                                        <h4 class="text-center">Order Completed!! </h4>
                                    </div>
                                    @endif
                                    @if ($orderDetail->status == 'Back To Sender')
                                    <div class="general-button">
                                        <h4 class="text-center">Package Returned To Sender !! </h4>
                                    </div>
                                    @endif
                                </form>
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
                confirmButtonText:"Yes update status!!",cancelButtonText:"No, cancel it !!",
                closeOnConfirm:1,closeOnCancel:1},
                function(e){
                    if(e)
                        $(form).submit();
                }
            )
        });
    </script>
@endsection
