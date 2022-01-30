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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="{{Storage::url($user->image)}}" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{$user->name}}</h3>
                                    </div>
                                </div>

                                <h4>About Me</h4>
                                <p class="text-muted">{{$user->summary}}</p>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{$user->phone}}</span></li>
                                    <li><strong class="text-dark mr-4">Email</strong> <span>{{$user->email}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('profile.store', myhash($user->id) ) }}" enctype="multipart/form-data" class="form-valide" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-group">
                                        <div class="input-group col-md-5">
                                            <div class="">
                                                <input type="file" accept="image/*" name="photo" class="form-control-file">
                                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>FirstName</label>
                                            <input type="text" class="form-control"  value="{{$user->firstname}}" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>LastName</label>
                                            <input type="text" class="form-control"  value="{{$user->lastname}}" name="lastname" placeholder="Last Name">
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
