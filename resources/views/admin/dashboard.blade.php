@extends('admin.layouts.app')

@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-3">

            
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Orders Completed</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$dashboard['orders']}}</h2>
                                    <p class="text-white mb-0 d-none">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Net Profit</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">@money($dashboard['profit'])</h2>
                                    <p class="text-white mb-0 d-none">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total Riders</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$dashboard['drivers']}}</h2>
                                    <p class="text-white mb-0 d-none">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-motorcycle"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total Fleet</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{$dashboard['vehicles']}}</h2>
                                    <p class="text-white mb-0 d-none">Jan - March 2019</p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-car"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Activity</h4>
                                <div id="activity">
                                    @foreach ($dashboard['activity'] as $item)
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                        <img width="35" src="{{$admin_source}}/images/avatar/1.jpg" class="mr-3 rounded-circle">
                                        <div class="media-body">
                                            <h5>{{$item->title}}</h5>
                                            <p class="mb-0">{{$item->description}}</p>
                                        </div><span class="text-muted ">{{$item->created_at->toFormattedDateString()}}</span>
                                    </div>
                                    @endforeach
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
