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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Pickup/Delivery Pricing</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pricings</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Pickup</th>
                                            <th>Dropoff</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pricing as $item)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$item->pickup->location}}
                                            </td>
                                            <td>
                                                {{$item->destination->location}}
                                            </td>
                                            <td>
                                                @money($item->price) 
                                            </td>
                                            
                                            {{-- <td class="" >
                                                <span class="{{ $item->status == 1 ? 'label gradient-1' : 'label gradient-2'}} "> {{$item->status == 1 ? 'Active' : 'Inactive'}} </span>
                                            </td>
                                             --}}
                                            <td>
                                                <form action="{{ route('pricing.destroy', $item->id)}}" method="post">@csrf @method('delete')
                                                    <span>
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
