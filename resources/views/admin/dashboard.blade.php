@extends('admin.layouts.app')

@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">
                <h2>
                    Welcome to your Dashboard, {{ucwords($user->lastname.' '.$user->firstname)}}
                </h2>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
