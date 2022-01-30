<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Helpers\MS;
use App\Http\Controllers\Controller;
use App\Mail\McSoniaMail;
use App\Models\User;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view("admin.profile", compact('user'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $id = decodeHash($request->id);
            $check = User::find($id);
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
                    $check->image = $f['path'];
                }
                $check->save();
                UserActivityService::log($user->id,UserActivityConstants::PROFILE_ACTIVITY,"Profile Update","User Updated Profile",null);
                DB::commit();
                return redirect()->route('profile')->with('message','Data Updated Successfully');
            }
            //toastr
            return redirect()->route('profile')->with('info','Data Not Found ');
        }catch (Exception $e) {
            dd($e);
            DB::rollback();
        }
    }

    public function changePassword(Request $request){
        $user = Auth::user();
        if (!(Hash::check($request->current_password, $user->password))) {
            return redirect()->back()->with("error","Your current password does not match with the default password.");
        }
        if(strcmp($request->current_password, $request->new_password) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        try {

            $user->password = bcrypt($request->new_password);
            $user->save();

            $details = [
                'title' => "Account Notification",
                'body' => "Your Mcsonia Account Password was changed on $user->updated_at .\n
                Please if you did not perform this action, contact the Administrator \n"
            ];

            Mail::to($user->email)->send(new McSoniaMail($details));

            UserActivityService::log($user->id,UserActivityConstants::PROFILE_ACTIVITY,"Progile Update","User Updated Password",null);
            return redirect()->route('profile.changePassword')->with('message','Password Sucessfully Changed!');

        }catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with("message","Password not successfully changed!");
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
        //
    }
}
