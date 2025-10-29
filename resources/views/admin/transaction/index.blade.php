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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Transactions</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Transactions</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>User</th>
                                            <th>Order Reference</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $item)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{(!empty($item->user)) ? $item->user->firstname.' '.$item->user->lastname : $item->user_email}}
                                            </td>
                                            <td>
                                                @if ($item->order)
                                                <a class="text-bold text-primary" href="{{route('orders.show', $item->order->id)}}">
                                                     {{$item->reference ?? ''}}
                                                 </a>
                                                @else
                                                <a class="text-bold text-primary" href="#">
                                                     {{$item->reference ?? ''}}
                                                 </a>
                                                @endif
                                            </td>
                                            <td>
                                                @money($item->amount)
                                            </td>
                                            <td>
                                                <span class="{{ $item->status == 'Failed' ? 'label gradient-2' : 'label gradient-1'}} "> {{$item->status}} </span>
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

@endsection
