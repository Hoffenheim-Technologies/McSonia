<?php

namespace App\Http\Controllers;

use App\Models\AccountCharts;
use App\Models\faq;
use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Vendor;
use Exception;

class AjaxController extends Controller
{
    public function location($id) {
        try{
            $destination = Pricing::where('pickup_id', $id)->get();
            return response()->json(array('destination'=> $destination), 200);
        }catch(Exception $a){
            return response()->json(array('error' => $a), 300);
        }
    }

    public function getFaq($id){
        try {
            $faq = faq::where('id', $id)->get();
            return response()->json(array('faq'=> $faq), 200);
        } catch (\Throwable $th) {
            return response()->json(array('error' => $th), 300);
        }
    }

    public function getAccounts()
    {
        try {
            $accounts = [];
            $accounts['income_accounts'] = AccountCharts::where('type','<>','Expenses')->get();
            $accounts['expense_accounts'] = AccountCharts::where('type','<>','Income')->get();
            return response()->json($accounts, 200);
        } catch (\Throwable $th) {
            return response()->json(array('error' => $th), 300);
        }
    }


}
