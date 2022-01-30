<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Helpers\MS;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index(){
        $clients = User::where('role','=','default')->orderBy('created_at', 'desc')->get();
        return view("admin.clients.index", compact('clients'));
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
            $orders = Order::where('user_id',$id)->orderBy('created_at', 'desc')->get();
            return view("admin.clients.show", compact('user','orders'));
        } catch (\Throwable $th) {
            return redirect()->route('clients')->with('info','Data Not Found');
        }
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
                UserActivityService::log($user->id,UserActivityConstants::PROFILE_ACTIVITY,"Profile Update","User Updated Client Profile",$data);
                DB::commit();
                return redirect()->route('clients.show', $request->id)->with('message','Data Updated Successfully');
            }
            //toastr
        }catch (Exception $e) {
            DB::rollback();
        }
    }

}
