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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Vendors</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
            <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Vendors</h4>
                                <div class="card-body text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_vendor">Add Vendor</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Company Name</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vendors as $item)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$item->company_name}}
                                                </td>
                                                <td>
                                                    {{$item->full_name}}
                                                </td>
                                                <td>
                                                   Phone: {{$item->phone}} <br>
                                                   Email: {{$item->email}}
                                                </td>
                                                <td>
                                                   {{$item->address}} <br>
                                                   City:  {{$item->city}} <br>
                                                   State: {{$item->state}} <br>
                                                   Country: {{$item->country}}
                                                </td>
                                                <td>
                                                    <form action="{{ route('vendors.destroy' , $item)}}" method="post">
                                                        @csrf @method('delete')
                                                        <span>
                                                            <a class="btn btn-info btn-sm mx-2" onclick="getVendor({{$item->id}})" ><i class="fa fa-pencil color-info"></i> Edit</a>
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
                <div class="modal fade" id="add_vendor">
                    <div class="modal-dialog " role="document">
                        <form action="{{ route('vendors.store') }}" enctype="multipart/form-data" class="form-valide" method="POST">
                            @csrf @method('POST')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADD VENDOR</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" value="{{old('company_name')}}" name="company_name" placeholder="Company Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" id="" name="full_name" value="{{old('full_name')}}" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" value="{{old('phone')}}" name="phone" placeholder="Phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="" name="email" value="{{old('email')}}" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>State</label>
                                            <input type="text" class="form-control" value="{{old('state')}}" name="state" placeholder="State">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="" name="city" value="{{old('city')}}" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" value="{{old('country')}}" name="country" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <label>Address</label>
                                            <textarea class="form-control" id="" name="address" placeholder="Address"> {{old('address')}} </textarea>
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
                <div class="modal fade" id="edit_vendor">
                    <div class="modal-dialog " role="document">
                        <form id="updateVendor" action="" enctype="multipart/form-data" class="form-valide" method="POST">
                            @csrf @method('PUT')
                             <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Vendor</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" value="" id="company_name" name="company_name" placeholder="Company Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" value="" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" value="" id="phone" name="phone" placeholder="Phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>State</label>
                                            <input type="text" class="form-control" value="" id="state" name="state" placeholder="State">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="city" name="city" value="" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Country</label>
                                            <input type="text" class="form-control" value="" id="country" name="country" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <label>Address</label>
                                            <textarea class="form-control" id="address" name="address" placeholder="Address">  </textarea>
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


                function getVendor(id) {
                    var action = '{{route('vendors.update',[':id'])}}'
                    var url = '{{route('vendors.show',[':id'])}}'
                    action = action.replace(':id', id);
                    url = url.replace(':id', id);
                    $('#updateVendor').attr('action', action)
                    $.ajax({
                        type:'GET',
                        url:url,
                        data: id,
                        success: (response) => {
                            let vendor = response.vendor[0]
                            $('#company_name').val(vendor.company_name)
                            $('#full_name').val(vendor.full_name)
                            $('#phone').val(vendor.phone)
                            $('#city').val(vendor.city)
                            $('#email').val(vendor.email)
                            $('#state').val(vendor.state)
                            $('#country').val(vendor.country)
                            $('#address').val(vendor.address)
                            $('#edit_vendor').modal('toggle');
                        },
                        error: (e) => {

                        }
                    });
                }

            </script>

        @endsection
