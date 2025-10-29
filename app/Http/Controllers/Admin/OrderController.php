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
use App\Mail\McSoniaMail;
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
use Illuminate\Support\Facades\Mail;

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
        if($orders){
            foreach($orders as $item){
                if($item->user_id){
                    $item->user = User::find($item->user_id);
                }
                $item->order_detail = OrderDetails::where('order_id',$item->id)->first();
            }
        }
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
            $order->item = Items::find($order->item);
            if($order->user_id){
                $order->user = User::find($order->user_id);
            }
            $reports = Report::where('reference_id',$order->id)->orderBy('created_at','DESC')->get();
            if($reports){
                foreach($reports as $item){
                    $item->user = User::find($item->user_id);
                }
            }

            $drivers = User::where('role','driver')->get();
            if($drivers){
                foreach($drivers as $item){
                    $item->vehicle = Vehicles::where('user_id',$item->id)->first();
                    $item->pending_order = OrderDetails::where('user_id',$item->id)
                                                        ->where('status','<>','Completed')
                                                        ->count();
                }
            }


            $orderDetail = OrderDetails::where('order_id','=',$order->id)->first();
            //dd($orderDetail);
            if($orderDetail){
                $orderDetail->statusNo = OrderStatusConstants::ORDER_STATUS_NO[$orderDetail->status];
                $orderDetail->driver = User::where('id',$orderDetail->user_id)->first();
            }
            return view('admin.order.show', compact('order','drivers','orderDetail','reports'));
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
            $location = Location::find($order->plocation);
            $order->plocation = $location->location;
            $location = Location::find($order->dlocation);
            $order->dlocation = $location->location;
            $item = Items::find($order->item);
            $order->item = $item->item;
            $driver = User::find($driver);

            $data = [];
            $data['user_id'] = $driver->id;
            $data['order_id'] = $order->id;
            $data['status'] = 'Awaiting Pickup By Driver';
            OrderDetails::create($data);
            DB::commit();

            $details = [
                'title' => "New Order Notification",
                'body' => "A new Order #$order->reference has been assigned to you .   \r\n
                The details are below:    \r\n
                Pickup Location: $order->plocation    \r\n
                Pickup Address: $order->paddress   \r\n
                Pickup Time: $order->pdate on $order->ptime   \r\n
                Dropoff Location: $order->dlocation    \r\n
                Dropoff Address: $order->daddress   \r\n
                Item: $order->item   \r\n
                Description: $order->description   \r\n
                Please contact the Administrator, for more information    \r\n"
            ];

            Mail::to($driver->email)->send(new McSoniaMail($details));

            UserActivityService::log($user->id,UserActivityConstants::ORDER_ACTIVITY,"Order Proccessed","User Assigned Order To Driver $driver->lastname",null);
            return redirect()->route('orders.show', $order->id)->with('message','Driver Assigned Successfully');
        }catch(Exception $ae){
            dd($ae);
            DB::rollback();
            return redirect()->route('orders.show', $order->id)->with('error','Driver Assign Unsuccessful');

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
                return redirect()->route('orders.show', $orderDetail->order_id)->with('message','Order Updated Successfully');
            }else{
                return redirect()->route('orders.show', $orderDetail->order_id)->with('error','Unable to Update');
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
        //dd($order);
        $user = Auth::user();
        try {
            $order = Order::find($order->id);
            $orderDetail = OrderDetails::where('order_id',$order->id)->first();
            if($orderDetail){
                $orderDetail->delete();
            }
            $order->delete();
            UserActivityService::log($user->id,UserActivityConstants::PRICING_ACTIVITY,"Order Deleted","User Deleted Order",null);
            return redirect()->route('orders.index')->with('message','Data Deleted Successfully');
        }catch (Exception $e) {
            return redirect()->route('orders.index')->with('error','Data Not Found');
        }
    }
}
