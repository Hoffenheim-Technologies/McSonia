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
use App\Models\Items;
use App\Models\OrderDetails;
use App\Models\Report;
use App\Models\User;
use App\Models\Vehicles;
use App\Services\Activity\User\UserActivityService;
use Carbon\Carbon;
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
            $order->item = Items::find($order->item);
            $reports = Report::where('reference_id',$order->id)
                                ->where('user_id',Auth::user()->id)
                                ->orderBy('created_at','DESC')->get();
            if($reports){
                foreach($reports as $item){
                    $item->user = User::find($item->user_id);
                }
            }
            if($order->user_id){
                $order->user = User::find($order->user_id);
            }

            $orderDetail = OrderDetails::where('order_id','=',$order->id)->first();

            if($orderDetail){
                $orderDetail->statusNo = OrderStatusConstants::ORDER_STATUS_NO[$orderDetail->status];
                $orderDetail->driver = User::where('id',$orderDetail->user_id)->first();
            }
            return view('driver.order.show', compact('order','orderDetail','reports'));
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        DB::beginTransaction();
        $orderDetail = OrderDetails::find($id);
        try {
            if($orderDetail){
                $orderDetail->status = $request->status;
                if($request->status == 'On Route To Deliver'){
                    $orderDetail->pickup_ts = Carbon::now();
                }
                if($request->status == 'Canceled'){
                    $orderDetail->canceled_ts = Carbon::now();
                }
                if($request->status == 'Completed'){
                    $orderDetail->completed_ts = Carbon::now();
                }
                $orderDetail->save();
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::ORDER_ACTIVITY,"Order Updated","User Updated Order Status",null);
                return redirect()->route('order.show', $orderDetail->order_id)->with('message','Order Updated Successfully');
            }else{
                return redirect()->route('order.show', $orderDetail->order_id)->with('error','Unable to Update');
            }
        } catch (Exception $th) {
            DB::rollBack();
            dd($th);
        }
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
