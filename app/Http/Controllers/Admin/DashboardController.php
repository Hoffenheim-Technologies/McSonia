<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $dashboard = [];
        $dashboard['orders'] = OrderDetails::where('status','Completed')->count();
        $dashboard['profit'] = 0.00;
        $dashboard['drivers'] = User::where('role','driver')->count();
        $dashboard['vehicles'] = Vehicles::count();
        //dd($dashboard);
        return view("admin.dashboard", compact('user','dashboard'));
    }
}
