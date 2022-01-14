<?php

namespace App\Http\Controllers\Driver;

use App\Constants\OrderStatusConstants;
use App\Constants\UserActivityConstants;
use App\Models\Order;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Vehicles;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrderDetails::where('user_id',Auth::user()->id)
                                ->orderBy('created_at', 'desc')->get();
        if($orders){
            foreach($orders as $item){
                $item->order = Order::find($item->order_id);
                $item->order->user = User::find($item->order->user_id) ?? null;
            }
        }
        //dd($orders);
        return view('driver.order.index', compact('orders'));
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
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = Order::find($order->id);
        if($order){
            $order->plocation = Location::find($order->plocation);
            $order->dlocation = Location::find($order->dlocation);
            if($order->user_id){
                $order->user = User::find($order->user_id);
            }

            $orderDetail = OrderDetails::where('order_id','=',$order->id)->first();

            if($orderDetail){
                $orderDetail->statusNo = OrderStatusConstants::ORDER_STATUS_NO[$orderDetail->status];
                $orderDetail->driver = User::where('id',$orderDetail->user_id)->first();
            }
            return view('driver.order.show', compact('order','orderDetail'));
        }
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

    }
}
