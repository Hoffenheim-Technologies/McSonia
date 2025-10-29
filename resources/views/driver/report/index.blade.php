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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Reports</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Reports</h4>
                            <div class="card-body text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_report">Add Report</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Comment</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $item)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{$item->category}}
                                            </td>
                                            <td>
                                                {{$item->description}}
                                            </td>
                                            <td>
                                                {{$item->comments}}
                                            </td>
                                            <td>
                                                {{$item->created_at->toDayDateTimeString()}}
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
                                                <select name="category" id="" class="form-control">
                                                    <option selected value="General">General Report</option>
                                                </select>
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
@endsection
