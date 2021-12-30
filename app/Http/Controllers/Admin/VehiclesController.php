<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Constants\VehicleTypesConstants;
use App\Models\Vehicles;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiclesRequest;
use App\Http\Requests\UpdateVehiclesRequest;
use App\Models\User;
use App\Services\Activity\User\UserActivityService;
use Exception;
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
        return view("admin.vehicle.index", compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $types = VehicleTypesConstants::VEHICLE_TYPES;
            $drivers = User::where('role','driver')->get();
            return view('admin.vehicle.create', compact('drivers','types'));
        }catch(Exception $e){
            dd($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVehiclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehiclesRequest $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = [];
            $data['vehicle_name'] = $request->vehicle_name;
            $data['user_id'] = $request->user_id;
            $data['reg_no'] = $request->reg_no;
            $data['type'] = $request->type;
            $data['description'] = $request->description;
            $data['make'] = $request->make;
            $data['year'] = $request->year;
            $data['model'] = $request->model;
            $data['condition'] = $request->condition;
            $data['status'] = $request->status;

            Vehicles::create($data);
            DB::commit();
            UserActivityService::log($user->id,UserActivityConstants::VEHICLE_ACTIVITY,"Vehicle Created","User Added Vehicle",$data);
            return redirect()->route('vehicles.create')->with('message','Data Created Successfully');

        }catch(Exception $as){
            DB::rollback();
            //dd($as);
            return redirect()->route('vehicles.create')->with('error','Data Entry Unsuccessful, Check Values');
        }
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
            $drivers = User::where('role','driver')->get();
            return view('admin.vehicle.show', compact('vehicle','drivers','types'));
        }catch(Exception $e){
            dd($e);
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
        $user = Auth::user();
        $vehicle = Vehicles::find($id);
        if(!empty($vehicle)){
            DB::beginTransaction();
            try {
                $vehicle->vehicle_name = $request->vehicle_name;
                $vehicle->user_id = $request->user_id;
                $vehicle->reg_no = $request->reg_no;
                $vehicle->type = $request->type;
                $vehicle->description = $request->description;
                $vehicle->make = $request->make;
                $vehicle->year = $request->year;
                $vehicle->model = $request->model;
                $vehicle->condition = $request->condition;
                $vehicle->status = $request->status;

                $vehicle->save();
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::VEHICLE_ACTIVITY,"Vehicle Updated","User Updated Vehicle", null);
                return redirect()->route('vehicles.show', $id)->with('message','Data Updated Successfully');

            }catch(Exception $as){
                DB::rollback();
                dd($as);
                return redirect()->route('vehicles.show', $id)->with('error','Data Entry Unsuccessful, Check Values');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        try {
            $vehicle = Vehicles::find($id);
            if(!empty($vehicle)){
                $vehicle->delete();
                UserActivityService::log($user->id,UserActivityConstants::VEHICLE_ACTIVITY,"Vehicle Deleted","User Deleted Vehicle",null);
                return redirect()->route('vehicles.index')->with('message','Data Deleted Successfully');
            }
        }catch (Exception $e) {
            //dd($e);
            return redirect()->route('vehicles.index')->with('error','Unable to delete');
        }
    }
}
