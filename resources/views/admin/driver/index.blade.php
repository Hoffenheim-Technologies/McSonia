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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Drivers</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Drivers</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Orders Completed</th>
                                                <th>Orders Pending</th>
                                                <th>Date Added</th>
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
                                                    <a href="mailto:{{$item->email}}">{{$item->email}}</a>
                                                </td>
                                                <td>
                                                    {{$item->completed_order}}
                                                </td>
                                                <td>
                                                    {{$item->pending_order}}
                                                </td>
                                                <td>
                                                    {{$item->created_at->toDayDateTimeString()}}
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm mx-2" href="{{route('drivers.show', $item->id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-info"></i> Edit</a>

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
