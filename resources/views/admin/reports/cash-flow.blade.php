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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Cash Flow Report</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Cash Flow Report</h4>
                                <form class="d-none">
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
                                <div class="table-responsive mt-2">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th>
                                              <h4>GROSS CASH INFLOW</h4>
                                            </th>
                                            <th>
                                            <h4> GROSS CASH OUTFLOW</h4>
                                            </th>
                                            <th>
                                            <h4> NET CASH CHANGE</h4>
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>
                                              <h4> <span class="text-success">@money($total_data->cash_inflow ?? 0.00)</span> </h4>
                                            </td>
                                            <td>
                                            <h4> <span class="text-danger">- @money($total_data->cash_outflow ?? 0.00)</span> </h4>
                                            </td>
                                            <td>
                                            <h4> <span class="{{($total_data->op_profit > 0) ? 'text-success' : 'text-danger'}}">@money($total_data->op_profit ?? 0.00)</span> </h4>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                      <h3>CASH INFLOW AND OUTFLOW</h3>
                                    </div>
                                      <div class="col-12">
                                        <h4 class="text-center">Operating Activities</h4>
                                        <div class="accordion m-4" id="accordionExample">
                                          <div class="card">
                                            <div class="card-header" id="headingOne">
                                              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                              <h4 class="text-dark"><span class="float-left">Sales</span><span class="float-right">@money($total_data->sales ?? 0)</span></h4>
                                              </button>
                                            </div>
                                            @if (!empty($sales_data))
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                              <div class="card-body">
                                                @foreach ($sales_data as $item)
                                                    <div class="row border-bottom m-3">
                                                        <div class="col-12">
                                                        <div class="float-left">
                                                            <h4> {{$item->details}} </h4>
                                                        </div>
                                                        <div class="float-right">
                                                            <h4>@money($item->amount)</h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row border-bottom m-3">
                                                  <div class="col-12">
                                                    <div class="float-left">
                                                      <h4> <strong> Total Sales </strong> </h4>
                                                    </div>
                                                    <div class="float-right">
                                                      <h4> <strong>@money($total_data->sales)</strong> </h4>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            </div>
                                            @endif
                                          </div>

                                        </div>
                                      </div>
                                      <hr>
                                      <div class="col-12">
                                        <h4 class="text-center">Investing Activities</h4>
                                        <div class="accordion m-4" id="accordionExample">

                                          <!-- property  plant -->
                                          <div class="card">
                                            <div class="card-header" id="headingSeven">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapsePropertyPlant" aria-expanded="true" aria-controls="collapsePropertyPlant">
                                                <h4 class="text-dark"><span class="float-left">Property, Plant, Equipment</span><span class="float-right">@money($total_data->property_plant ?? 0)</span></h4>
                                                </button>
                                            </div>
                                                @if (!empty($property_plant_data))
                                                    <div id="collapsePropertyPlant" class="collapse show" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            @foreach ($property_plant_data as $item)
                                                                <div class="row border-bottom m-3">
                                                                    <div class="col-12">
                                                                        <div class="float-left">
                                                                        <h4> {{$item->details}}</h4>
                                                                        </div>
                                                                        <div class="float-right">
                                                                        <h4>@money($item->amount)</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="row border-bottom m-3">
                                                                <div class="col-12">
                                                                    <div class="float-left">
                                                                        <h4> <strong> Total Sales </strong> </h4>
                                                                    </div>
                                                                    <div class="float-right">
                                                                        <h4> <strong>@money($total_data->property_plant)</strong> </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                          <!-- other_investment -->
                                          <div class="card">
                                            <div class="card-header" id="headingEight">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOtherInv" aria-expanded="false" aria-controls="collapseOtherInv">
                                                  <h4 class="text-dark"><span class="float-left">Other</span><span class="float-right">@money($total_data->other_inv ?? 0.00)</span></h4>
                                                </button>
                                            </div>
                                            @if (!empty($other_invest_data))
                                            <div id="collapseOtherInv" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                                                <div class="card-body">
                                                  @foreach ($other_invest_data as $other_inv)
                                                    <div class="row border-bottom m-3">
                                                        <div class="col-12">
                                                            <div class="float-left">
                                                                <h4>{{$other_inv->details}}</h4>
                                                            </div>
                                                            <div class="float-right">
                                                                <h4>@money($other_inv->amount)</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  @endforeach
                                                    <div class="row border-bottom m-3">
                                                      <div class="col-12">
                                                        <div class="float-left">
                                                          <h4> <strong> Total Other </strong> </h4>
                                                        </div>
                                                        <div class="float-right">
                                                          <h4> <strong>@money($total_data->other_invest)</strong> </h4>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                            @endif
                                          </div>

                                          <div class="row w-100">
                                            <div class="col-12 p-4">
                                              <h3 class="float-left">
                                                  Net Cash from Investing Activities
                                              </h3>
                                              <h3 class="float-right">
                                                  @money($total_data->invest)
                                              </h3>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <hr>
                                      <!-- Financing activities -->
                                      <div class="col-12">
                                        <h4 class="text-center">Financing Activities</h4>
                                        <div class="accordion m-4" id="accordionExample">

                                          <!-- Loans credit -->
                                          <div class="card">
                                            <div class="card-header" id="headingNine">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseLoans" aria-expanded="true" aria-controls="collapseLoans">
                                                <h4 class="text-dark"><span class="float-left">Loans and Lines of Credit</span><span class="float-right"> @money($total_data->loans ?? 0.00) </span></h4>
                                                </button>
                                            </div>

                                            @if (!empty($loans_data))
                                            <div id="collapseLoans" class="collapse show" aria-labelledby="headingNine" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @foreach ($loans_data as $loans)
                                                    <div class="row border-bottom m-3">
                                                        <div class="col-12">
                                                        <div class="float-left">
                                                            <h4> {{$loans->details}} </h4>
                                                        </div>
                                                        <div class="float-right">
                                                            <h4> @money($loans->amount) </h4>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="row border-bottom m-3">
                                                        <div class="col-12">
                                                            <div class="float-left">
                                                                <h4> <strong> Total Loans </strong> </h4>
                                                            </div>
                                                            <div class="float-right">
                                                                <h4> <strong> @money($total_data->loans) </strong> </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                          </div>

                                          <!-- owners_shareholders -->
                                          <div class="card">
                                            <div class="card-header" id="headingTen">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseShares" aria-expanded="false" aria-controls="collapseShares">
                                                  <h4 class="text-dark"><span class="float-left">Owners and Shareholders</span><span class="float-right"> @money($total_data->owner_share ?? 0) </span></h4>
                                                </button>
                                            </div>

                                            @if (!empty($owner_share_data))
                                            <div id="collapseShares" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    @foreach ($owner_share_data as $owner_share)
                                                        <div class="row border-bottom m-3">
                                                            <div class="col-12">
                                                            <div class="float-left">
                                                                <h4>{{$owner_share->details}}</h4>
                                                            </div>
                                                            <div class="float-right">
                                                                <h4>@money($owner_share->amount)</h4>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="row border-bottom m-3">
                                                      <div class="col-12">
                                                        <div class="float-left">
                                                          <h4> <strong> Total Other </strong> </h4>
                                                        </div>
                                                        <div class="float-right">
                                                          <h4> <strong>@money($total_data->owner_share)</strong> </h4>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                            @endif
                                          </div>


                                          <!-- other_finance -->
                                          <div class="card">
                                            <div class="card-header" id="headingEleven">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOtherfin" aria-expanded="false" aria-controls="collapseOtherfin">
                                                  <h4 class="text-dark"><span class="float-left">Other</span><span class="float-right">@money($total_data->other_fin ?? 0)</span></h4>
                                                </button>
                                            </div>

                                            @if (!empty($other_finance_data))
                                            <div id="collapseOtherfin" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                                              <div class="card-body">
                                                @foreach ($other_finance_data as $other_fin)
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4>{{$other_fin->details}}</h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4>@money($other_fin->amount)</h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                                @endforeach
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4> <strong> Total Other </strong> </h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4> <strong>@money($total_data->other_finance)</strong> </h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                            @endif
                                          </div>

                                          <div class="row w-100">
                                            <div class="col-12 p-4">
                                              <h3 class="float-left">
                                                  Net Cash from Financing Activities
                                              </h3>
                                              <h3 class="float-right">
                                                  @money($total_data->finance)
                                              </h3>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!-- overview -->
                                      <hr>
                                      <div class="col-12">
                                        <h4 class="text-center">Overview</h4>
                                        <div class="accordion m-4" id="accordionExample">

                                          <!-- Loans credit -->
                                          <div class="card">
                                            <div class="card-header" id="headingTwelve">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseStarting" aria-expanded="true" aria-controls="collapseStarting">
                                                <h4 class="text-dark"><span class="float-left">Starting Balance</span></h4>
                                                </button>
                                            </div>

                                              <div id="collapseStarting" class="collapse show" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <div class="row border-bottom m-3">
                                                      <div class="col-12">
                                                        <div class="float-left">
                                                          <h4> Cash On Hand </h4>
                                                        </div>
                                                        <div class="float-right">
                                                          <h4>&#8358; 0.00 </h4>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4> <strong> Total Starting Balance </strong> </h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4>&#8358; 0.00 </h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4>  Gross Cash Inflow </h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4> @money($total_data->cash_inflow)</h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4>  Gross Cash Outflow </h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4> <strong>@money($total_data->cash_outflow)</strong> </h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4> <strong> Net Cash Change </strong> </h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4> <strong>@money($total_data->op_profit)</strong> </h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                          <!-- Ending Balance -->
                                          <div class="card">
                                            <div class="card-header" id="headingThirteen">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEndd" aria-expanded="false" aria-controls="collapseEndd">
                                                  <h4 class="text-dark"><span class="float-left">Ending Balance</span></h4>
                                                </button>
                                            </div>

                                            <div id="collapseEndd" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                                              <div class="card-body">
                                                  <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                      <div class="float-left">
                                                        <h4> <strong> Total Ending Balance </strong> </h4>
                                                      </div>
                                                      <div class="float-right">
                                                        <h4> <strong>@money($total_data->op_profit)</strong> </h4>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
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
@section('custom-script')
    <script>

    </script>
@endsection
