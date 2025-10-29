<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\UserActivityLog;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $dashboard = [];
        $dashboard['completed_orders'] = OrderDetails::where('user_id',Auth::user()->id)
                                                    ->where('status','Completed')->count();
        $dashboard['pending_orders'] = OrderDetails::where('user_id',Auth::user()->id)
                                                    ->where('status','Awaiting Pickup By Driver')->count();
        $dashboard['vehicles'] = Vehicles::where('user_id',Auth::user()->id)
                                            ->count();
        $dashboard['activity'] = UserActivityLog::where('email',Auth::user()->email)
                                                 ->where('activity','!=','PROFILE_ACTIVITY')
                                                 ->orderBy('created_at', 'desc')->paginate(5);

        return view("driver.dashboard", compact('user','dashboard'));
    }

    public function activity(){
        $activity = UserActivityLog::where('email',Auth::user()->email)
                                    ->orderBy('created_at', 'desc')->get();
        foreach($activity as $item){
            $item->user = User::where('email',$item->email)->first();
        }
        return view("driver.activity", compact('activity'));
    }
}
