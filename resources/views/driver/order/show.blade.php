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
                            <div class="card-body text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_report">Add Report</button>
                            </div>

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
                                                    <strong>Reference:</strong> {{$order->reference}}
                                                </p>
                                                <p>
                                                    <strong>Name:</strong> {{ucfirst($order->user->lastname ?? $order->lastname)}} {{ucfirst($order->user->firstname ?? $order->firstname)}}
                                                </p>
                                                <p>
                                                    <strong>Phone:</strong> <a class="text-primary" href="tel:+{{$order->user->phone ?? $order->phone}}">{{$order->user->phone ?? $order->phone}}</a>
                                                </p>
                                                <p>
                                                    <strong>Email:</strong> <a class="text-primary" href="mailto:{{$order->user->email ?? $order->email}}">{{$order->user->email ?? $order->email}}</a>
                                                </p>
                                                <p>
                                                    <strong>Company:</strong> {{$order->company}}
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="list-two" role="tabpanel">
                                                <p>
                                                    <strong>Reference:</strong> {{$order->reference}}
                                                </p>
                                                <p>
                                                    <strong>Pickup Location:</strong> {{($order->plocation->location) ?? ' ' }}
                                                </p>
                                                <p>
                                                    <strong>Pickup Address:</strong> {{$order->paddress}}
                                                </p>
                                                <p>
                                                    <strong>Pickup Time:</strong> {{$order->pdate.' '.$order->ptime}}
                                                </p>
                                                <p>
                                                    <strong>Dropoff Location:</strong> {{($order->dlocation->location) ?? ' ' }}
                                                </p>
                                                <p>
                                                    <strong>Dropoff Address:</strong> {{$order->daddress}}
                                                </p>
                                                <p>
                                                    <strong>Item:</strong> {{$order->item->item}}
                                                </p>
                                                <p>
                                                    <strong>Description:</strong> {{$order->description}}
                                                </p>
                                                <p>
                                                    <strong>Discount:</strong> @money($order->discount)
                                                </p>
                                                <p>
                                                    <strong>Sub Total:</strong> @money($order->subtotal)
                                                </p>
                                                <p>
                                                    <strong>Total:</strong> @money($order->total)
                                                </p>
                                                <p>
                                                    <strong>Status:</strong> <span class="badge {{$order->status != 'Pending' ? 'badge-primary' : 'badge-warning text-white'}} px-2">{{$order->status}}</span>
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
                                        <input type="submit" name="status" value="On Route To Deliver" class="btn mb-1 confirm-btn btn-primary">
                                    </div>
                                    @endif
                                    @if ($orderDetail->status == 'On Route To Deliver')
                                    <div class="general-button">
                                        <input type="submit" name="status" value="Back To Sender" class="btn confirm-btn mb-1 btn-warning">
                                        <input type="submit" name="status" value="Delivered" class="btn mb-1 confirm-btn btn-info">
                                    </div>
                                    @endif
                                    @if ($orderDetail->status == 'Delivered')
                                    <div class="general-button">
                                        <input type="submit" name="status" value="Back To Sender" class="btn confirm-btn mb-1 btn-secondary">
                                        <input type="submit" name="status" value="Cancel" class="btn mb-1 confirm-btn btn-danger">
                                        <input type="submit" name="status" value="Completed" class="btn mb-1 confirm-btn btn-success">
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

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order Reports</h4>
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
                                                <input type="text" readonly value="Order" class="form-control" name="category">
                                                <input type="hidden" name="reference_id" value="{{$order->id}}">
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
    <script>
        $('.confirm-btn').on('click',function(e){
            var status = $(this).val();
            var form_applet = `<input type="hidden" name="status" value="${status}" />`;
            e.preventDefault();

            var form = $(this).parents('form:first');

            swal({title:"Are you sure ?",
                text:"Do you want to perform this action? !!",
                type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",
                confirmButtonText:"Yes update status!!",cancelButtonText:"No, cancel it !!",
                closeOnConfirm:1,closeOnCancel:1},
                function(e){
                    if(e){
                        $(form).append(form_applet);
                        $(form).submit();
                    }
                }
            )
        });
    </script>
@endsection
