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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Driver</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Driver {{$user->firstname}}</h4>
                                <form action="{{ route('staffs.update', $user->id) }}" enctype="multipart/form-data" class="form-valide" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-group">
                                        <div class="input-group col-md-7">
                                            <div class="bootstrap-media">
                                                <div class="media">
                                                    <img class="mr-3 img-fluid" width="80" height="80" src="{{Storage::url($user->image)}}" alt="{{$user->firstname}} image">
                                                </div>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="photo" class="custom-file-input">
                                                <label class="custom-file-label">Choose file</label>
                                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>FirstName</label>
                                            <input type="firstname" class="form-control"  value="{{$user->firstname}}" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>LastName</label>
                                            <input type="lastname" class="form-control"  value="{{$user->lastname}}" name="lastname" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="val-email" value="{{$user->email}}" readonly placeholder="Email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" id="val-address" name="address" value="{{$user->address}}" placeholder="1234 Main St">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Profile Summary</label>
                                            <input type="text" class="form-control" name="summary" value="{{$user->summary}}" placeholder="Summary">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" id="val-phoneus" value="{{$user->phone}}" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary px-3 ml-4">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ucwords($user->firstname)}} Memo</h4>
                                <form class="" action="{{route('staffs.storeMemo',$user)}}" method="post">
                                    @csrf @method('POST')
                                    <div class="form-row">
                                        <div class="form-group col-7">
                                            <textarea name="memo" placeholder="Memo" class="form-control" cols="20" rows="3" id=""> </textarea>
                                        </div>
                                        <div class="form-group align-items-center col-4">
                                            <button type="submit" class="btn btn-primary px-3 ml-4">Submit</button>
                                        </div>

                                    </div>
                                </form>
                                <div id="activity">
                                    @foreach ($memos as $item)
                                        <div class="media border-bottom-1 pt-3 pb-3">
                                            <div class="media-body">
                                                <p class="mb-0">{{$item->memo}}</p>
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
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
@section('custom-script')
    <script src="admins/plugins/validation/jquery.validate.min.js"></script>
    <script src="admins/plugins/validation/jquery.validate-init.js"></script>
@endsection
