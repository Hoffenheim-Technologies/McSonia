<?php

namespace App\Http\Controllers\Admin;

use App\Models\AccountCharts;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountChartsRequest;
use App\Http\Requests\UpdateAccountChartsRequest;

class AccountChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = AccountCharts::get();
        return view('admin.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountChartsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountChartsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountCharts  $accountCharts
     * @return \Illuminate\Http\Response
     */
    public function show(AccountCharts $accountCharts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountCharts  $accountCharts
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountCharts $accountCharts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountChartsRequest  $request
     * @param  \App\Models\AccountCharts  $accountCharts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountChartsRequest $request, AccountCharts $accountCharts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountCharts  $accountCharts
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountCharts $accountCharts)
    {
        //
    }
}
