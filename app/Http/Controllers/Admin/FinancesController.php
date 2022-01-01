<?php

namespace App\Http\Controllers\Admin;

use App\Models\Finances;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinancesRequest;
use App\Http\Requests\UpdateFinancesRequest;

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
        //
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
