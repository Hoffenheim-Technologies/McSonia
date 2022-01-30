<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Account\FinanceService;
use App\Services\Payment\TransactionService;
use App\Services\Activity\User\UserActivityService;
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
        if($paymentDetails['data']['status'] == 'success'){
            $paymentData = $paymentDetails['data'];
            $metadata = $paymentData['metadata'];
            //dd($metadata);
            try {

                $order = Order::find($metadata['order_id']);
                $order->status = 'Paid';
                $order->save();

                FinanceService::log(
                    'Cash In Bank',
                    'Self',
                    null,
                    'Income',
                    'Cash And Bank',
                    'Sales',
                    $order->reference,
                    $paymentData['amount']/100
                );

                TransactionService::log(
                    $order->user_id ?? null,
                    $order->email,
                    $order->reference,
                    'Paystack',
                    'Order Booking',
                    $paymentData['amount']/100,
                    'Success'
                );

                return redirect()->route('thankYou',$order);

            } catch (\Throwable $th) {
                return Redirect::back()->withMessage(['msg'=>'Please try again.', 'type'=>'error']);
            }

        }else{
            return Redirect::back()->withMessage(['msg'=>'Please try again.', 'type'=>'error']);
        }
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
