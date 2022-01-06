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
                                    <div class="form-row">
                                        <div class="form-group">
                                            <div class="form-group col-md-4">
                                                <label>Date</label>
                                                <input type="date" class="form-control" value="" name="date">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Type</label>
                                                <input type="text" class="form-control" value="" name="type" placeholder="Type">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Beneficiary</label>
                                                <input type="text" class="form-control" value="" name="beneficiary" placeholder="Beneficiary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <div class="form-group col-md-4">
                                                <label>Category</label>
                                                <input type="date" class="form-control" value="" name="date">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Details</label>
                                                <input type="text" class="form-control" value="" name="type" placeholder="Type">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Description</label>
                                                <input type="text" class="form-control" value="" name="description" placeholder="Description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Beneficiary</th>
                                                    <th>Category</th>
                                                    <th>Account</th>
                                                    <th>Details</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                                <tr class="record">
                                                    <td>
                                                        <span class="font-weight-bold sn">1</span>
                                                    </td>
                                                    <td>
                                                        <input type="date" id="date" class="form-control" name="date" value="" placeholder="">
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="type" id="type">
                                                            <option value="Income">

                                                            </option>
                                                            <option value="Expense">

                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea id="beneficiary" class="form-control" name="beneficiary" rows="3" value="" placeholder=""></textarea>
                                                    </td>
                                                    <td>
                                                        <select name="category" id="category">
                                                            <option value="">

                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="account" id="account">
                                                            <option value="">

                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="account" id="account">
                                                            <option value="">

                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>

                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
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
                function getDate(){
                    return new Date()
                }
                console.log(getDate())
            </script>
        @endsection
