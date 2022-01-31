<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetails;
use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with('total', count(Order::where('user_id', Auth::id())->get()))
            ->with('pending', count(Order::where('user_id', Auth::id())->where('status', 'Pending')->get()))
            ->with('complete', count(Order::where('user_id', Auth::id())->where('status', 'Completed')->get()))
            ->with('cancelled', count(Order::where('user_id', Auth::id())->where('status', 'Canceled')->get()))
;
    }

}