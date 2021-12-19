<?php

namespace App\Http\Controllers\Admin;

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
        $orders = Order::orderBy('created_at', 'desc')->get();
        //dd($orders);
        return view('admin.order.index', compact('orders'));
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
        $order->paddress = $request->paddress;
        $order->dlocation = $request->dlocation;
        $order->daddress = $request->daddress;
        if(Auth::check()){
            $order->user_id = Auth::id();
        } else {
            $order->firstname = $request->firstname;
            $order->lastname = $request->lastname;
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
        //DB::enableQueryLog();
        $order = Order::find($order->id);
        if($order){
            $order->plocation = Location::find($order->plocation);
            $order->dlocation = Location::find($order->dlocation);

            $drivers = User::where('role','driver')->get();
            if($drivers){
                foreach($drivers as $item){
                    $item->vehicle = Vehicles::where('user_id',$item->id)->first();
                }
            }
            $orderDetail = OrderDetails::where('order_id','=',2)->first();
            //dd($orderDetail);
            if($orderDetail){
                $orderDetail->statusNo = OrderStatusConstants::ORDER_STATUS_NO[$orderDetail->status];
                $orderDetail->driver = User::where('id',$orderDetail->user_id)->first();
            }
            return view('admin.order.show', compact('order','drivers','orderDetail'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  int $driver
     * @param  int $order
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request,  $driver,  $order)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $order = Order::find($order);
            $driver = User::find($driver);

            $data = [];
            $data['user_id'] = $driver->id;
            $data['order_id'] = $order->id;
            $data['status'] = 'Pending';
            OrderDetails::create($data);
            DB::commit();
            UserActivityService::log($user->id,UserActivityConstants::ORDER_ACTIVITY,"Order Proccessed","User Assigned Driver To Order",null);
            return redirect()->route('order.show', $order->id)->with('message','Driver Assigned Successfully');
        }catch(Exception $ae){
            dd($ae);
            DB::rollback();
            return redirect()->route('order.show', $order->id)->with('error','Driver Assign Unsuccessful');

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
        $user = Auth::user();
        try {
            $order = Order::find($order->id);
            $order->delete();
            UserActivityService::log($user->id,UserActivityConstants::PRICING_ACTIVITY,"Order Deleted","User Deleted Order",null);
            return redirect()->route('order.index')->with('message','Data Deleted Successfully');
        }catch (Exception $e) {
            return redirect()->route('order.index')->with('error','Data Not Found');
        }
    }
}
