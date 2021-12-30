<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVendorRequest;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::orderBy('created_at', 'desc')->get();
        return view("admin.vendor.index", compact('vendors'));
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
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = [];
            $data['company_name'] = $request->company_name;
            $data['full_name'] = $request->full_name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['state'] = $request->state;
            $data['country'] = $request->country;
            $data['city'] = $request->city;

            Vendor::create($data);
            DB::commit();
            UserActivityService::log($user->id,UserActivityConstants::VENDOR_ACTIVITY,"Vendor Created","User Added Vendor",$data);
            return redirect()->route('vendors.index')->with('message','Data Created Successfully');

        }catch(Exception $as){
            DB::rollback();
            return redirect()->route('vendors.index')->with('error','Data Entry Unsuccessful, Check Values');
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
        $vendor = Vendor::where('id', $id)->get();
        return response()->json(array('vendor'=> $vendor), 200);
        } catch (\Throwable $th) {
            return response()->json(array('error' => $th), 300);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
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
            $vendor = Vendor::find($id);
            if(!empty($vendor)){
                $vendor->company_name = $request->company_name;
                $vendor->full_name = $request->full_name;
                $vendor->phone = $request->phone;
                $vendor->email = $request->email;
                $vendor->address = $request->address;
                $vendor->state = $request->state;
                $vendor->country = $request->country;
                $vendor->city = $request->city;
                $vendor->save();
                UserActivityService::log($user->id,UserActivityConstants::VENDOR_ACTIVITY,"Vendor Update","User Updated Vendor",null);
                DB::commit();
                return redirect()->route('vendors.index')->with('message','Data Updated Successfully');
            }
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->route('vendors.index')->with('error','Unable to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        try {
            $vendor = Vendor::find($id);
        if(!empty($vendor)){
            $vendor->delete();
            UserActivityService::log($user->id,UserActivityConstants::VENDOR_ACTIVITY,"Vendor Deleted","User Deleted Vendor",null);
            return redirect()->route('vendors.index')->with('message','Data Deleted Successfully');
        }
        }catch (Exception $e) {
            dd($e);
            return redirect()->route('vendors.index')->with('error','Unable to Delete');
        }
    }
}
