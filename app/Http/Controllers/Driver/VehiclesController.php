<?php

namespace App\Http\Controllers\Driver;

use App\Constants\UserActivityConstants;
use App\Constants\VehicleTypesConstants;
use App\Models\Vehicles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiclesRequest;
use App\Http\Requests\UpdateVehiclesRequest;
use App\Models\User;
use App\Models\VehicleMemo;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicles::orderBy('created_at', 'desc')->get();
        foreach($vehicles as $item){
            if(!empty($item->user_id)){
                $item->driver = User::find($item->user_id);
            }else{
                $item->driver = '';
            }
        }
        return view("driver.vehicle.index", compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVehiclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehiclesRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $vehicle = Vehicles::find($id);
            $vehicle->driver = User::find($vehicle->user_id);
            $types = VehicleTypesConstants::VEHICLE_TYPES;
            $memos = VehicleMemo::where('vehicle_id',$id)->get();
            return view('driver.vehicle.show', compact('vehicle','types','memos'));
        }catch(Exception $e){
            //dd($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMemo($id, Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $check = Vehicles::find($id);
            if($check){
                $data = [];
                $data['memo'] = $request->memo;
                $data['vehicle_id'] = $id;
                VehicleMemo::create($data);
                UserActivityService::log($user->id,UserActivityConstants::MEMO_ACTIVITY,"Memo Create","User Added Memo For Vehicle ".$id,null);
                DB::commit();
                return redirect()->route('vehicle.show',$id)->with('message','Memo Added Successfully');
            }
            return redirect()->route('vehicle.show',$id)->with('error','Data Not Found');
        }catch (Exception $e) {
            //dd($e);
            DB::rollback();
            return redirect()->route('vehicle.show',$id)->with('error','Data Entry Unsuccessful, Check Values');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicles $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehiclesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehiclesRequest $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
