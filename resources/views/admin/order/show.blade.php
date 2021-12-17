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
                                                    Name: {{ucwords($order->lastname.' '.$order->firstname)}}
                                                </p>
                                                <p>
                                                    Phone: <a href="tel:+{{$order->phone}}">{{$order->phone}}</a>
                                                </p>
                                                <p>
                                                    Email: <a href="mailto:{{$order->email}}">{{$order->email}}</a>
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
                                                    Status: {{$order->status}}
                                                </p>

                                            </div>
                                            <div class="tab-pane fade" id="list-three" role="tabpanel">
                                                Reference: {{$order->reference}}
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
                                <h4 class="card-title">Other</h4>
                                <h5> Assign Driver</h5>

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
