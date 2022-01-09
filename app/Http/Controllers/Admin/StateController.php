<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $states = State::all();
        return view('admin.state.index')->with('states', $states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.state.state-new');
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
            $data = [];
            $data['state'] = $request->state;
            $state = State::where('state', '=', $data['state'])->first();
            if ($state === null) {
                State::create($data);
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::STATE_ACTIVITY,"State Created","User Added State", null);
                return redirect()->route('state.create')->with('message','Data Created Successfully');
            }else{
                return redirect()->route('state.create')->with('error','Data Already Exists');
            }
        } catch(Exception $as) {
            DB::rollback();
            //throw new Exception;
            dd($as);
            return redirect()->route('items.create')->with('error','Data Entry Unsuccessful, Check Values');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        try {
            $item = State::find($id);
        if(!empty($item)){
            $item->delete();
            UserActivityService::log($user->id,UserActivityConstants::STATE_ACTIVITY,"State Deleted","User Deleted State",null);
            return redirect()->route('state.index')->with('message','Data Deleted Successfully');
        }
        }catch (Exception $e) {
            dd($e);
        }
    }
}
