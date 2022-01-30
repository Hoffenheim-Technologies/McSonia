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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Items</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Items</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$item->item}}
                                            </td>
                                            <td>
                                                {{$item->price}}
                                            </td>
                                            <td>
                                                <form action="{{ route('items.destroy' , $item)}}" method="post">@csrf @method('delete')
                                                    <span>
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
        })
    </script>
@endsection
