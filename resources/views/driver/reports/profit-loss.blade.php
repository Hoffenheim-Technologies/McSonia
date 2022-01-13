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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profit Loss Report</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-5">Profit Loss Report</h4>
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
                                <div class="row">
                                    <div class="col-12">
                                      <div class="card shadow mt-2 mb-4">
                                        <div class="card-body">
                                          <table class="table">
                                            <thead>
                                              <tr>
                                                <th>
                                                  <h4>Income</h4>
                                                </th>
                                                <th>
                                                 <h4> Cost Of Goods Sold</h4>
                                                </th>
                                                <th>
                                                 <h4> Operating Expense</h4>
                                                </th>
                                                <th>
                                                 <h4> Net Profit</h4>
                                                </th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            `````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````-                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>
                                                  <h4>@money($total_data->income ?? 0.00)</h4>
                                                </td>
                                                <td>
                                                 <h4>- @money($total_data->goods ?? 0.00)</h4>
                                                </td>
                                                <td>
                                                 <h4>- @money($total_data->expense ?? 0.00)</h4>
                                                </td>
                                                <td>
                                                 <h4><span class="{{($total_data->profit > 0) ? 'text-success' : 'text-danger' }}"> @money($total_data->profit ?? 0.00) </span> </h4>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="accordion m-4" id="accordionExample">
                                    <div class="card">
                                      <div class="card-header" id="headingOne">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          <h4 class="text-dark"><span class="float-left">Income</span><span class="float-right">{{empty($income_data) ? '0.00' : ''}}</span></h4>
                                          </button>
                                      </div>

                                      @if (!empty($income_data))
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                @foreach ($income_data as $income)
                                                <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                    <div class="float-left">
                                                        <h4> {{$income->details}} </h4>
                                                    </div>
                                                    <div class="float-right">
                                                        <h4>@money($income->amount)</h4>
                                                    </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                        <div class="float-left">
                                                            <h4> <strong> Total Income </strong> </h4>
                                                        </div>
                                                        <div class="float-right">
                                                            <h4> <strong>@money($total_data->income)</strong> </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      @endif

                                    <div class="card">
                                      <div class="card-header" id="headingTwo">
                                          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h4 class="text-dark"><span class="float-left">Cost of Goods Sold</span><span class="float-right"> {{empty($goods_data) ? '0.00' : ''}} </span></h4>
                                          </button>
                                      </div>
                                      @if (!empty($goods_data))
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                            <!--{foreach $goods_data as $goods}-->
                                            @foreach ($goods_data as $goods)
                                                <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                        <div class="float-left">
                                                        <h4>{{$goods->details}} </h4>
                                                        </div>
                                                        <div class="float-right">
                                                        <h4>@money($goods->amount)</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!--{/foreach}-->
                                            <div class="row border-bottom m-3">
                                                <div class="col-12">
                                                <div class="float-left">
                                                    <h4> <strong> Total Cost Of Goods Sold </strong> </h4>
                                                </div>
                                                <div class="float-right">
                                                    <h4> <strong>@money($total_data->goods)</strong> </h4>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                      @endif
                                      <!--{if !empty($goods_data)}-->

                                    </div>
                                    <!--{/if}-->

                                    <div class="card">
                                      <div class="card-header" id="headingThree">
                                        <h1 class="mb-0">
                                          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <h4 class="text-dark"><span class="float-left">Operating Expenses</span><span class="float-right">{{empty($expense_data) ? '0.00' : ''}}</span>
                                          </button>
                                        </h1>
                                      </div>

                                      @if (!empty($expense_data))
                                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            @foreach ($expense_data as $expense)
                                                <div class="row border-bottom m-3">
                                                    <div class="col-12">
                                                    <div class="float-left">
                                                        <h4> {{$expense->details}} </h4>
                                                    </div>
                                                    <div class="float-right">
                                                        <h4>@money($expense->amount)</h4>
                                                    </div>
                                                    </div>
                                              </div>
                                            @endforeach
                                          <div class="row border-bottom m-3">
                                            <div class="col-12">
                                              <div class="float-left">
                                                <h4> <strong> Total Operating Expenses </strong> </h4>
                                              </div>
                                              <div class="float-right">
                                                <h4> <strong>@money($total_data->expense)</strong> </h4>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      @endif
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
