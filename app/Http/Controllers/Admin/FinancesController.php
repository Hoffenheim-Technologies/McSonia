<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Models\Finances;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinancesRequest;
use App\Http\Requests\UpdateFinancesRequest;
use App\Models\AccountCharts;
use App\Services\Account\FinanceService;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finances = Finances::orderBy('created_at','desc')->get();
        return view('admin.finances.index', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = AccountCharts::where('type','Assets')->get();
        $income_accounts = AccountCharts::where('type','<>','Expenses')->get();
        $expense_accounts = AccountCharts::where('type','<>','Income')->get();
        return view('admin.finances.create', compact('accounts','income_accounts','expense_accounts'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = json_decode($request->getContent(), true);
            foreach($data as $item){
                FinanceService::log($item['account'], $item['beneficiary'], $item['payment_type'], $item['payment_category'], $item['category'], $item['details'],$item['description'],$item['amount'],$item['transaction_date']);
                UserActivityService::log($user->id,UserActivityConstants::FINANCE_ACTIVITY,"Finance Create","User Created Finance",$item);
            }
            DB::commit();
            return response()->json(array('message'=> 'Data Created Successfully'), 200);

        }catch (Exception $e) {
            DB::rollback();
            dd($e);
            return response()->json(array('message'=> 'Data Entry Unsuccessful, Check Values'), 400);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function show(Finances $finances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function edit(Finances $finances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFinancesRequest  $request
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinancesRequest $request, Finances $finances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finances  $finances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finances $finances)
    {
        $user = Auth::user();
        try {
            $finance = Finances::find($finances->id);
            if($finance){
                $finance->delete();
                UserActivityService::log($user->id,UserActivityConstants::FINANCE_ACTIVITY,"Finance Deleted","User Deleted Finance",null);
                return redirect()->route('finances.index')->with('message','Data Deleted Successfully');
            }
        }catch (Exception $e) {
            return redirect()->route('finances.index')->with('error','Data Not Found');
        }
    }
}
