<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::get();
        //dd($locations);
        return view('admin.location.locations', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.locations-new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = [];
            $data['pickup'] = $request->pickup;
            $data['destination'] = $request->destination;
            $data['ststus'] = $request->status;
            $data['amount'] = $request->amount;

            Location::create($data);
            DB::commit();
            UserActivityService::log($user->id,UserActivityConstants::LOCATION_ACTIVITY,"Location Created","User Added Location",null);
            return redirect()->route('locations.create')->with('message','Data Created Successfully');

        }catch(Exception $as){
            DB::rollback();
            //throw new Exception;
            dd($as);
            return redirect()->route('locations.create')->with('error','Data Entry Unsuccessful, Check Values');
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
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $location = Location::find($id);
        if(!empty($location)){
            $location->destroy();
            UserActivityService::log($user->id,UserActivityConstants::LOCATION_ACTIVITY,"Location Deleted","User Deleted Location",null);
            DB::commit();
            
            return redirect()->route('locations')->with('message','Data Deleted Successfully');
        }
        }catch (Exception $e) {
            DB::rollback();
        }
    }
}
