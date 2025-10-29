<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Models\Order;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetails;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicles;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        if($transactions){
            foreach($transactions as $item){
                if($item->reference){
                    $item->order = Order::where('reference',$item->reference)->first();
                }
                if($item->user_id){
                    $item->user = User::find($item->user_id);
                }
            }
        }
        //dd($transactions);
        return view('admin.transaction.index', compact('transactions'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

    }
}
