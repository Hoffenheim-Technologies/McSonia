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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Frequently Asked Questions</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">FAQ's</h4>
                                <div class="card-body text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_faq">Add FAQ</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Question</th>
                                                <th>Answer</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($faqs as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$item->question}}
                                                </td>
                                                <td>
                                                    {{$item->answer}}
                                                </td>
                                                <td>
                                                    {{$item->created_at->toDayDateTimeString()}}
                                                </td>
                                                <td>
                                                    <form action="{{ route('faqs.destroy' , $item)}}" method="post">
                                                        @csrf @method('delete')
                                                        <span>
                                                            <a class="btn btn-info btn-sm text-light mx-2" onclick="getFaq({{$item->id}})" ><i class="fa fa-pencil color-info"></i> Edit</a>
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
                <div class="modal fade" id="add_faq">
                    <div class="modal-dialog " role="document">
                        <form action="{{ route('faqs.store') }}" enctype="multipart/form-data" class="form-valide" method="POST">
                            @csrf @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADD FAQ</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Question</label>
                                                <input type="text" class="form-control" value="{{old('question')}}" name="question" placeholder="Question">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Answer</label>
                                                <input type="text" class="form-control" id="" name="answer" value="{{old('answer')}}" placeholder="Answer">
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
            <div class="bootstrap-modal">
                <div class="modal fade" id="edit_faq">
                    <div class="modal-dialog " role="document">
                        <form id="updateFaq" action="" enctype="multipart/form-data" class="form-valide" method="POST">
                            @csrf @method('PUT')
                             <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update FAQ</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Question</label>
                                                <input type="text" class="form-control" id="question" value="{{old('question')}}" name="question" placeholder="Question">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-10">
                                                <label>Answer</label>
                                                <input type="text" class="form-control" id="answer" name="answer" value="{{old('answer')}}" placeholder="Answer">
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


                function getFaq(id) {
                    var action = '{{route('faqs.update',[':id'])}}'
                    action = action.replace(':id', id);
                    $('#updateFaq').attr('action', action)
                    $.ajax({
                        type:'GET',
                        url:`/faqs/${id}`,
                        data: id,
                        success: (response) => {
                            let faq = response.faq[0]
                            $('#question').val(faq.question)
                            $('#answer').val(faq.answer)
                            $('#edit_faq').modal('toggle');
                        },
                        error: (e) => {
                            //console.log(e);
                        }
                    });
                }

            </script>

        @endsection
