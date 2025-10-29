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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Sales Report</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Sales Report</h4>
                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <h5 class="box-title m-t-30">Date Range</h5>
                                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" >

                                        </div>
                                        <div class="col-auto align-self-end">
                                            <button type="submit" class="btn btn-dark px-3 mx-2 mb-2">Submit</button>
                                        </div>
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
    <script>

    </script>
@endsection
