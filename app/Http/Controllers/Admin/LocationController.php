<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\State;
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
        $states = State::all();
        $locations = Location::get();
        return view('admin.location.index', compact('locations'))->with('states', $states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('admin.location.locations-new')->with('states', $states);
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
            $data['state_id'] = $request->state;
            $data['location'] = $request->location;
            $location = Location::where('location', '=', $data['location'])->first();
            if ($location === null) {
                Location::create($data);
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::LOCATION_ACTIVITY,"Location Created","User Added Location",null);
                return redirect()->route('locations.create')->with('message','Data Created Successfully');
            }else{
                return redirect()->route('locations.create')->with('error','Data Already Exists');
            }
        }catch(Exception $as){
            DB::rollback();
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
        try {
            $location = Location::find($id);
            if(!empty($location)){
                $location->delete();
                UserActivityService::log($user->id,UserActivityConstants::LOCATION_ACTIVITY,"Location Deleted","User Deleted Location",null);
                return redirect()->route('locations.index')->with('message','Data Deleted Successfully');
            }
        }catch (Exception $e) {
            dd($e);
        }
    }
}
