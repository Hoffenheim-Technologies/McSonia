<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\Finances;
use App\Models\Report;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportsController extends Controller
{


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $report = Report::find($id);
        if(!empty($report)){
            DB::beginTransaction();
            try {
                $report->comments = $request->comments;
                $report->save();
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::REPORT_ACTIVITY,"Report Commented","User Commented On $report->category Report", null);
                return redirect()->back()->with('message','Data Updated Successfully');

            }catch(Exception $as){
                DB::rollback();
                //dd($as);
                return redirect()->back()->with('error','Data Entry Unsuccessful, Check Values');
            }
        }
    }

    public function cash_flow(){
        $total_data = new stdClass();

        //operating income
        $operating_income = 0;
        //sales
        $total_sales = 0;
        $sales_data = [];
        $all_sales = Finances::select(DB::raw('sum(amount) as amount, details'))
                                ->where('category','Income')
                                ->groupBy('details')
                                ->get();
        if(!empty($all_sales)){
            foreach($all_sales as $value){
                $operating_income += $value->amount;
            }
        }
        $total_data->sales = $operating_income;
        $total_data->cash_inflow = $operating_income;
        $sales_data = $all_sales;

        //operating expense
        $operating_expense = 0;
        //purchase
        $purchases_data = [];
        $total_purchases = 0;
        $all_purchases = Finances::select(DB::raw('sum(amount) as amount, details'))
                                    ->where('category','Operating Expense')
                                    ->groupBy('details')
                                    ->get();
        if(!empty($all_purchases)){
            foreach($all_purchases as $value){
                $total_purchases += $value->amount;
            }
        }
        $total_data->purchases = $total_purchases;
        $operating_expense += $total_purchases;
        $purchases_data = $all_purchases;


        //inventory
        $inventory_data = [];
        $total_inventory = 0;
        $all_inventory = Finances::select(DB::raw('sum(amount) as amount, details'))
                                    ->where('category','Inventory')
                                    ->groupBy('details')
                                    ->get();
        if(!empty($all_inventory)){
            foreach($all_inventory as $value){
                $total_inventory += $value->amount;
            }
        }
        $total_data->inventory = $total_inventory;
        $operating_expense += $total_inventory;
        $inventory_data = $all_inventory;

        //payroll
        $total_payroll = 0;
        $payroll_data = [];
        $all_payroll = Finances::select(DB::raw('sum(amount) as amount, details'))
                                    ->where('category','Payroll Expenses')
                                    ->groupBy('details')
                                    ->get();
        if(!empty($all_payroll)){
            foreach($all_payroll as $value){
                $total_payroll += $value->amount;
            }
        }
        $total_data->payroll = $total_payroll;
        $operating_expense += $total_payroll;
        $payroll_data = $all_payroll;

        $total_data->cash_outflow = $operating_expense;


        //net cashflow
        $total_data->op_profit = $total_data->cash_inflow - $total_data->cash_outflow;


        //investing expense
        $investing_expense = 0;
            //property plant
            $total_property_plant = 0;
            $property_plant_data = [];
            $all_property_plant = Finances::select(DB::raw('sum(amount) as amount, details'))
                                                        ->where('category','Property, Plant, Equipment')
                                                        ->groupBy('details')
                                                        ->get();

            if(!empty($all_property_plant)){
                foreach($all_property_plant as $value){
                    $total_property_plant += $value->amount;
                }
            }
            $total_data->property_plant = $total_property_plant;
            $investing_expense += $total_property_plant;
            $property_plant_data = $all_property_plant;

            //other_inv
            $total_other_invest = 0;
            $other_data = [];
            $other_invest_data = [];
            $all_other_invest = Finances::select(DB::raw('sum(amount) as amount, details'))
                                                    ->where('category','Other Investment')
                                                    ->groupBy('details')
                                                    ->get();
            if(!empty($all_other_invest)){
                foreach($all_other_invest as $value){
                    $total_other_invest += $value->amount;
                }
            }
            $total_data->other_invest = $total_other_invest;
            $investing_expense += $total_other_invest;
            $other_invest_data = $all_other_invest;

            $total_data->invest = $investing_expense;

        //financing income
            $financing_income = 0;
            //Loans Credit
            $total_loans = 0;
            $loans_data = [];
            $all_loans = Finances::select(DB::raw('sum(amount) as amount, details'))
                                        ->where('category','Loans And Lines Of Credit')
                                        ->groupBy('details')
                                        ->get();
            if(!empty($all_loans)){
                foreach($all_loans as $value){
                    $total_loans += $value->amount;
                }
            }
            $total_data->loans = $total_loans;
            $financing_income += $total_loans;
            $loans_data = $all_loans;

            //owners_shares
            $total_owners_shares = 0;
            $owner_share_data = [];
            $all_owner_shares = Finances::select(DB::raw('sum(amount) as amount, details'))
                                            ->where('category','Business Owner Contribution And Drawing')
                                            ->groupBy('details')
                                            ->get();
            if(!empty($all_owner_shares)){
                foreach($all_owner_shares as $value){
                    $total_owners_shares += $value->amount;
                }
            }
            $total_data->owner_share = $total_owners_shares;
            $financing_income += $total_owners_shares;
            $owner_share_data = $all_owner_shares;


            //other_finance
            $total_other_finance = 0;
            $other_finance_data = [];
            $all_other_finance = Finances::select(DB::raw('sum(amount) as amount, details'))
                                                    ->where('category','Other Finances')
                                                    ->groupBy('details')
                                                    ->get();
            if(!empty($all_other_finance)){
                foreach($all_other_finance as $value){
                    $total_other_finance += $value->amount;
                }
            }
            $total_data->other_finance = $total_other_finance;
            $financing_income += $total_other_finance;
            $other_finance_data = $all_other_finance;

            $total_data->finance = $financing_income;
            $total_data->cash_inflow += $financing_income;
            $total_data->net_cash = $total_data->cash_inflow - $total_data->cash_outflow;

        return view('admin.reports.cash-flow', compact('total_data','sales_data','purchases_data','inventory_data','property_plant_data','payroll_data','property_plant_data','other_invest_data','loans_data','owner_share_data','other_finance_data'));
    }
    public function balance_sheet(){

        return view('admin.reports.balance-sheet');
    }
    public function profit_loss(){
        $finances = Finances::all();
        $total_data = new stdClass();
        $income_data = [];
        $goods_data = [];
        $expense_data = [];
        if(!empty($finances)){
            $total_income = 0;
            $total_expense = 0;
            $total_goods = 0;
            $total_profit = 0;
            foreach($finances as $value){
                if($value->category == 'Income'){
                    array_push($income_data, $value);
                    $total_income += $value->amount;
                }
                if($value->category == 'Operating Expense'){
                    array_push($expense_data, $value);
                    $total_expense += $value->amount;
                }
                if($value->category == 'Cost Of Goods Sold'){
                    array_push($goods_data, $value);
                    $total_goods += $value->amount;
                }
            }
            $total_profit = $total_income - $total_goods - $total_expense;
            $total_data->income = $total_income;
            $total_data->expense = $total_expense;
            $total_data->goods = $total_goods;
            $total_data->profit = $total_profit;
        }

        return view('admin.reports.profit-loss', compact('total_data','income_data','goods_data','expense_data'));
    }

    public function sales_report(){
        return view('admin.reports.sales-report');
    }

    public function defaulters(){

        return view('admin.reports.defaulters');
    }
}
