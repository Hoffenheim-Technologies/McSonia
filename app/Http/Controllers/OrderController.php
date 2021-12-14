<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request');
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $order = new Order;
        $order->pdate = $request->pdate;
        $order->ptime = $request->ptime;
        $order->plocation = $request->plocation;
        $order->dlocation = $request->dlocation;
        if(Auth::check()){
            $order->user_id = Auth::id();
        } else {
            $order->firstname = $request->fname;
            $order->lastname = $request->lname;
            $order->email = $request->email;
            $order->phone = $request->phone;
        }
        if($request->billing == 1){
            $order->company = $request->company;
            $order->tax = $request->tax;
            $order->street = $request->street;
            $order->snumber = $request->snumber;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->postal = $request->postal;
            $order->country = $request->country;
        }
        if($request->discount){
            $order->discount = $request->discount;
        }
        function random_strings($length_of_string)
        {
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

            return substr(str_shuffle($str_result), 0, $length_of_string);
        }
        $order->reference = random_strings(8);

        $order->save();

        return view('request')->with('message', 'Done')->with('reference', $order->reference);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
