<?php

namespace App\Http\Controllers;

use App\Mail\McSoniaTestMail;
use App\Mail\McSoniaOrderMail;
use App\Models\faq;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    function testMail(){
        $details = [
            'name' => 'John Doe',
            'title' => 'Test Mail',
            'body' => 'This is for testing email durhhh'
        ];

        Mail::to('abiolamishael@gmail.com')->send(new McSoniaTestMail($details));

        dd("Email is Sent.");
    }

    public function orderEmailToClient(Order $order){
        if($order->user_id){
            $order->user = User::find($order->user_id);
            $name = $order->user->firstname.' '.$order->user->lastname;
        }else{
            $name = $order->user->firstname.' '.$order->user->lastname;
        }
        $company_name = \env('APP_NAME');
        $formatted_date = $order->created_at->toDayDateTimeString();
        $body = "
            Thank you for choosing $company_name on $formatted_date. Your booking #$order->reference has been received and will be processed immediately.
            Please confirm your Pickup and Dropoff Locations respectively
        ";
        $details = [
            'name' => $name,
            'title' => "Order Confirmation #$order->reference",
            'body' => $body,
            'order' => $order
        ];
        try{
            Mail::to($order->email)->send(new McSoniaOrderMail($details));
            return true;
        }catch(Exception $e){
            error_log($e);
            return false;
        }
    }
}
