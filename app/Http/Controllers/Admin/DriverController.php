<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Helpers\MS;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicles;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::where('role','driver')->get();
        return view("admin.driver.index", compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.driver.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $check = User::where('email',$request->email)->first();
            if(empty($check)){
                $data = [];
                $data['firstname'] = $request->firstname;
                $data['lastname'] = $request->lastname;
                $data['summary'] = $request->summary;
                $data['address'] = $request->address;
                $data['email'] = $request->email;
                $data['phone'] = $request->phone;
                $data['password'] = Hash::make(strtolower($request->lastname));
                $data['role'] = 'driver';
                $data['code'] = strtoupper(Str::random(10));

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $f = MS::getFileMetaData($photo);
                    $f['name'] = 'photo.' . $f['ext'];
                    $f['path'] = $photo->storeAs(MS::getUploadPath($data['role']) . $data['code'], $f['name']);
                    $data['image'] = asset('storage/app/' . $f['path']);
                }
                User::create($data);
                UserActivityService::log($user->id,UserActivityConstants::PROFILE_ACTIVITY,"Profile Create","User Created Driver Profile",null);
                DB::commit();
                return redirect()->route('drivers.create')->with('message','Data Created Successfully');
            }
            return redirect()->route('drivers.create')->with('info','Data Already Exists');
        }catch (Exception $e) {
            //dd($e);
            DB::rollback();
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
        try {
            $user = User::find($id);
            $orders = [];
            $vehicles = Vehicles::where('user_id',$user->id)->orderBy('created_at', 'desc')->get();
            return view("admin.driver.show", compact('user','orders','vehicles'));
        } catch (\Throwable $th) {
            return redirect()->route('drivers')->with('info','Data Not Found');
        }
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
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $check = User::find($request->id);
            if(!empty($check)){
                $data = [];
                $check->firstname = $request->firstname;
                $check->lastname = $request->lastname;
                $check->summary = $request->summary;
                $check->address = $request->address;
                $check->phone = $request->phone;
                $data['code'] = strtoupper(Str::random(10));

                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $f = MS::getFileMetaData($photo);
                    $f['name'] = 'photo.' . $f['ext'];
                    $f['path'] = $photo->storeAs(MS::getUploadPath($check->role) . $data['code'], $f['name']);
                    $check->image = asset('storage/' . $f['path']);
                }

                $check->save();
                UserActivityService::log($user->id,UserActivityConstants::PROFILE_ACTIVITY,"Profile Update","User Updated Driver Profile",$data);
                DB::commit();
                return redirect()->route('drivers.show', $request->id)->with('message','Data Updated Successfully');
            }
            //toastr
        }catch (Exception $e) {
            DB::rollback();
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
        //
    }
}
