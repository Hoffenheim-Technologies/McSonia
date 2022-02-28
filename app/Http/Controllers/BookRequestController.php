<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Location;
use App\Models\Order;
use App\Models\State;
use App\Http\Controllers\EmailController;
use App\Mail\McSoniaOrderMail;
use App\Mail\McSoniaMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use stdClass;

class BookRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(Request $request)
    {
        try{

        $order = new Order();
        $order->pdate = $request->pdate;
        $order->ptime = $request->ptime;
        $order->item = $request->item;
        $order->plocation = $request->plocation;
        $order->paddress = $request->paddress;
        $order->dlocation = $request->dlocation;
        $order->daddress = $request->daddress;
        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->firstname = Auth::user()->firstname;
            $order->lastname = Auth::user()->lastname;
            $order->email = Auth::user()->email;
            $order->phone = Auth::user()->phone;
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

        $order->subtotal = $request->subtotal ?? 0.00;
        $order->total = $request->total ?? 1000.00;
        $order->description = $request->comments ?? 'No Description Here';

        function random_strings($length_of_string)
        {
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

            return substr(str_shuffle($str_result), 0, $length_of_string);
        }

        $order->reference = random_strings(8);

        $order->save();

        //Mail Function
        if($order->user_id){
            $order->user = User::find($order->user_id);
            $name = $order->user->firstname.' '.$order->user->lastname;
        }else{
            $name = $request->firstname.' '.$request->lastname;
        }
        $company_name = \env('APP_NAME');
        $admin_email = \env('MAIL_ADMIN');
        $formatted_date = $order->created_at->toDayDateTimeString();
        $location = new stdClass();
        $locate = Location::find($request->plocation);
        $location->plocation = $locate->location;
        $locate = Location::find($request->dlocation);
        $location->dlocation = $locate->location;
        $location->paddress = $request->paddress;
        $location->daddress = $request->daddress;
        $body = "
            Thank you for choosing $company_name on $formatted_date. Your booking #$order->reference has been received and will be processed immediately.
            Please confirm your Pickup and Dropoff Locations respectively
        ";
        $details = [
            'name' => $name,
            'title' => "Order Confirmation #$order->reference",
            'body' => $body,
            'location' => $location,
            'description' => $order->description
        ];
        $details2 = [
            'title' => "New Order Booking #$order->reference",
            'body' => "You have received a new booking request with Order #$order->reference. Login to proceed with order request"
        ];
        //Mail Admin
        Mail::to($admin_email)->send(new McSoniaMail($details2));

        //Mail Client
        Mail::to($request->email)->send(new McSoniaOrderMail($details));


        return view('request')->with('message', 'Success')->with('reference', $order->reference)->with('order',$order);

        }catch(Exception $e){
            dd($e);
            error_log($e);
            return view('request')->with('message', 'Order Booking Unsuccesful');
        }
    }



    public function order(){
        return view('request')->with('locations', Location::all())->with('items', Items::all())->with('states', State::orderBy('state')->get());
    }


    public function thankYou($id){
        $order = Order::find($id);
        return view('thankYou',compact('order'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
