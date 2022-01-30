<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
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
        $items = Items::all();
        return view('admin.items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.items.item-new');
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
            $data['item'] = $request->item;
            $data['price'] = $request->price;
            $item = Items::where('item', '=', $data['item'])->first();
            if ($item === null) {
                Items::create($data);
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::ITEM_ACTIVITY,"Item Created","User Added Item", null);
                return redirect()->route('items.create')->with('message','Data Created Successfully');
            }else{
                return redirect()->route('items.create')->with('error','Data Already Exists');
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
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        try {
            $item = Items::find($id);
        if(!empty($item)){
            $item->delete();
            UserActivityService::log($user->id,UserActivityConstants::ITEM_ACTIVITY,"Item Deleted","User Deleted Item",null);
            return redirect()->route('items.index')->with('message','Data Deleted Successfully');
        }
        }catch (Exception $e) {
            dd($e);
        }
    }
}
