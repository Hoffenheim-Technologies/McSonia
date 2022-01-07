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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Finance</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Finances</h4>
                                    <div class="row">
                                        <div class="col-12 p-2">
                                            <a class="btn btn-warning px-3 ml-4 text-light add-record"><i class="fa fa-plus"></i> Add Row</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <form id="ajax-finance-store" method="post">
                                            @csrf @method('POST')
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Account</th>
                                                        <th>Beneficiary</th>
                                                        <th>Details</th>
                                                        <th>Amount</th>
                                                        <th></th>
                                                    <tr>
                                                </thead>
                                                <tbody id="table_body">
                                                    <tr id="record-1" class="record">
                                                        <td>
                                                            <span class="font-weight-bold sn">1</span>
                                                        </td>
                                                        <td>
                                                            <input type="date" id="date" class="form-control date" name="date" value="" placeholder="">
                                                        </td>
                                                        <td>
                                                            <select class="form-control type" name="type" id="type">
                                                                <option value="">
                                                                    Select
                                                                </option>
                                                                <option value="Income">
                                                                    Income
                                                                </option>
                                                                <option value="Expense">
                                                                    Expense
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="asset" class="form-control asset" id="asset">
                                                                <option value="">
                                                                    Select
                                                                </option>
                                                                @foreach ($accounts as $item)
                                                                    <option value="{{$item->account}}">
                                                                        {{$item->account}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <textarea id="beneficiary" class="form-control beneficiary" name="beneficiary" rows="3" value="" placeholder=""></textarea>
                                                        </td>
                                                        <td>
                                                            <select name="account" class="form-control account" id="account">
                                                                <option value="">
                                                                    Select
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="0" id="amount" class="form-control amount" name="amount" value="" placeholder="Amount">

                                                        </td>
                                                        <td>
                                                            <a class="delete-record text-danger" href=""><i class="fa fa-trash fa-2x"></i> </a>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="3" class="text-center">
                                                    Totals
                                                    </th>
                                                    <td class="text-center">
                                                        <label for="" class="form-control-label">Income Total</label>
                                                        <input id="creditTotal" type="number" class="form-control creditTotal badge-pill" name="credittotal" value="" placeholder="" required readonly>
                                                    </td>
                                                    <td class="text-center">
                                                        <label for="debitTotal" class="form-control-label">Expense Total</label>
                                                        <input id="debitTotal" type="number" class="form-control debitTotal badge-pill" name="debittotal" value="" placeholder="" required readonly>
                                                    </td>
                                                    <td class="text-center">
                                                        <label for="balanceTotal" class="form-control-label">Balance Total</label>
                                                        <input id="balanceTotal" type="number" class="form-control balanceTotal badge-pill" name="grandtotal" value="" placeholder="" required readonly>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>

                                            <div class="d-flex align-items-center">
                                                <button type="submit" class="btn btn-primary px-3 ml-4">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- #/ container -->
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        @endsection

        @section('custom-script')
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const sample_row = $('#record-1').clone();

                var url = `/accountsList`
                $.ajax({
                    type:'GET',
                    url:url,
                    data: [],
                    success: (response) => {
                        income_accounts = response.income_accounts
                        expense_accounts = response.expense_accounts
                    },
                    error: (e) => {
                        console.log(e);
                    }
                });

                function cloneRow(){
                    var content = $('#record-1'),
                    size = $('table > tbody > tr').length,
                    element = null,
                    element = content.clone();
                    size++;
                    element.id = 'record-'+size;
                    element.find('.sn').html(size);
                    element.find('.description').val('');
                    element.find('.amount').val('');
                    element.find('.beneficiary').val('');
                    element.find('.type')[0].selctedIndex = 0;
                    element.find('.asset')[0].selctedIndex = 0;
                    element.find('.account').empty();
                    element.find('.account').append(`<option value="">Select</option>`)
                    return element;
                }

                $(document).on('click', ".add-record", function() {
                   element = cloneRow();
                   element.appendTo('#table_body');
                });

                $(document).on('click', ".delete-record", function(e) {
                    size = $('table > tbody > tr').length;
                    if(size > 1){
                    var elementor = $(this).closest('.record');
                    e.preventDefault()
                    swal({
                            title:"Are you sure to delete ?",
                            text:"You will not be able to recover this data !!",
                            type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",
                            confirmButtonText:"Yes, delete it !!",closeOnConfirm:1},
                            function(e){
                                if(e){
                                    elementor.remove();
                                    $('#table_body tr').each(function(index) {
                                        $(this).find('span.sn').html(index+1);
                                    });
                                }
                            }
                        )
                    }else{
                    e.preventDefault()
                        swal({
                            title:"Stop",
                            text:"You need atleast 1 record",
                            type:"warning",showCancelButton:!0,
                            function(e){

                            }
                        })
                    }
                });

                $(document).on('change keyup', ".type", function() {
                    var select_element = $(this).closest('.record').find('.account');
                    select_element.empty()
                    switch ($(this).val()){
                        case 'Income':
                            select_element.append(`<option value="">Select</option>`)
                            for (items of income_accounts) {
                               select_element.append(`<option cat="${items.category}" value="${items.account}">${items.type} - ${items.account}</option>`)
                            }
                            break;
                        case 'Expense':
                            select_element.append(`<option  value="">Select</option>`)
                            for (items of expense_accounts) {
                               select_element.append(`<option cat="${items.category}" value="${items.account}">${items.type} - ${items.account}</option>`)
                            }
                            break;
                        default:
                            break;
                    }
                });

                $(document).on('change keyup', ".account", function() {
                    var select_element = $(this);
                    var select_option = select_element.find(":selected");
                    select_element.attr('cat', select_option.attr('cat'));
                });

                setInterval(() => {
                    calcAll();
                }, 1000);

                function calcAll(){
                    //data initialize
                    var data = $('#table_body tr');
                    var totalBalance = 0;
                    var totalIncome = 0;
                    var totalExpense = 0;
                    var amount = 0;

                    //loop through rows
                    data.each(function (row) {
                        try{
                            amount = $(this).find(".amount").val();
                            type = $(this).find(".type").val();
                        }catch(exc){
                            throw exc;
                        }
                        if(type == "Income"){
                            totalIncome += +amount;
                        }else if(type == "Expense"){
                            totalExpense += +amount;
                        }
                    });

                    totalBalance = totalIncome - totalExpense;
                    //record final values
                    $('#creditTotal').val(totalIncome);
                    $('#debitTotal').val(totalExpense);
                    $('#balanceTotal').val(totalBalance);
                }

                function getFinanceData(){

                    var table = $('#table_body tr');
                    var length = table.length;
                    var len = 0;
                    var TableData = new Array();

                    table.each(function (row) {

                        TableData[row]={
                            "transaction_date" : $(this).find(".date").val()
                            , "payment_type" : null
                            , "payment_category" : $(this).find(".type").val()
                            , "category" : $(this).find(".account").attr('cat')
                            , "account" : $(this).find(".asset").val()
                            , "amount" : $(this).find(".amount").val() ?? 0
                            , "details" : $(this).find(".account").val()
                            , "description" : null
                            , "beneficiary" : $(this).find(".beneficiary").val()
                        }

                    });

                    TableData = JSON.stringify(TableData);
                    return TableData;
                }

                $('#ajax-finance-store').on('submit', function(ev){
                    ev.preventDefault();
                    var data = getFinanceData();
                    var url = '{{ route('finances.store') }}';
                    $.ajax({
                        url:url,
                        type:'POST',
                        processData:false,
                        contentType:'json',
                        data: data,
                        success: (response) => {
                            $('#table_body').empty();
                            $('#table_body').append(sample_row);
                            toastr.success(response.message);
                        },
                        error: (e) => {
                            $('#table_body').empty();
                            $('#table_body').append(sample_row);
                            toastr.error(e.responseJSON.message);
                        }
                    });
                });


            </script>
        @endsection
