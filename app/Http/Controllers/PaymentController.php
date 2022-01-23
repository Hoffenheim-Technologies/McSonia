<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Account\FinanceService;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Paystack;

class PaymentController extends Controller
{

    public $paystack;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->paystack = new Paystack();
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return $this->paystack->getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            dd($e);
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = $this->paystack->getPaymentData();
        if($paymentDetails->data['status'] == 'success'){
            try {
                //update order payment info
                $order = Order::find($paymentDetails->data['order_id']);
                $order->status('Paid');
                $order->save();

                FinanceService::log(
                    $paymentDetails->data['account'],
                    $paymentDetails->data['beneficiary'],
                    $paymentDetails->data['payment_type'],
                    $paymentDetails->data['payment_category'],
                    $paymentDetails->data['category'],
                    $paymentDetails->data['details'],
                    $paymentDetails->data['description'],
                    $paymentDetails->data['amount'],
                    $paymentDetails->data['transaction_date']
                );

            } catch (\Throwable $th) {
                return Redirect::back()->withMessage(['msg'=>'Please try again.', 'type'=>'error']);

            }

        }else{

        }
        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
