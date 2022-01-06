<?php

namespace App\Http\Controllers\Admin;

use App\Models\Finances;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinancesRequest;
use App\Http\Requests\UpdateFinancesRequest;
use App\Models\AccountCharts;

class FinancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finances = Finances::all();
        return view('admin.finances.index', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = AccountCharts::all();
        $income_accounts = AccountCharts::where('type','<>','Exepnses')->get();
        $expense_accounts = AccountCharts::where('type','<>','Income')->get();
        return view('admin.finances.create', compact('accounts','income_accounts','expense_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFinancesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinancesRequest $request)
    {
        //
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
        //
    }
}
