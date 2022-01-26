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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Testimonials</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Testimonials</h4>
                                <div class="card-body text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_testimonial">Add Testimonial</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Client Name</th>
                                                <th>Comment</th>
                                                <th>Rating</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($testimonials as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$item->name}}
                                                </td>
                                                <td>
                                                    {{$item->comment}}
                                                </td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $item->rating)
                                                            <span class="fa fa-star text-warning"></span>
                                                        @else
                                                            <span class="fa fa-star"></span>
                                                        @endif
                                                    @endfor
                                                </td>
                                                <td>
                                                    <form action="{{ route('testimonials.destroy' , $item)}}" method="post">
                                                        @csrf @method('delete')
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

        <div class="col-lg-12">
            <div class="bootstrap-modal">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="add_testimonial">
                    <div class="modal-dialog " role="document">
                        <form action="{{ route('testimonials.store') }}" enctype="multipart/form-data" class="form-valide" method="POST">
                            @csrf @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADD TESTIMONIAL</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Client Name</label>
                                                <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Client Name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Comment</label>
                                                <textarea class="form-control" name="comment" id="" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Rating</label>
                                                <select name="rating" class="form-control" id="">
                                                    <option value="1"> 1 </option>
                                                    <option value="2"> 2 </option>
                                                    <option value="3"> 3 </option>
                                                    <option value="4"> 4 </option>
                                                    <option value="5"> 5 </option>
                                                </select>
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
                });

            </script>

        @endsection
