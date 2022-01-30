<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Requests\StorePricingRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePricingRequest;
use App\Models\Location;
use App\Models\Pricing;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricing = Pricing::get();
        if (!empty($pricing)) {
           foreach($pricing as $item){
            $item->pickup = Location::find($item->pickup_id);
            $item->destination = Location::find($item->dropoff_id);
           }
        }

        return view('admin.pricing.index', compact('pricing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::get();
        return view('admin.pricing.pricing-new', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePricingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePricingRequest $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = [];
            $data['pickup_id'] = $request->pickup_id;
            $data['dropoff_id'] = $request->dropoff_id;
            $data['price'] = $request->price;
            $pricing = Pricing::where('pickup_id', '=', $data['pickup_id'])
                                ->where('dropoff_id', '=', $data['dropoff_id'])->first();
            if ($pricing === null) {
                Pricing::create($data);
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::PRICING_ACTIVITY,"Pricing Created","User Added Pricing",null);
                return redirect()->route('pricing.create')->with('message','Data Created Successfully');
            }else{
                return redirect()->route('pricing.create')->with('error','Data Already Exists');
            }

        }catch(Exception $as){
            DB::rollback();
            return redirect()->route('pricing.create')->with('error','Data Entry Unsuccessful, Check Values');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function show(Pricing $pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricing $pricing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePricingRequest  $request
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePricingRequest $request, Pricing $pricing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $user = Auth::user();
        try {
            $pricing = Pricing::find($id);
            $pricing->delete();
            UserActivityService::log($user->id,UserActivityConstants::PRICING_ACTIVITY,"Pricing Deleted","User Deleted Pricing",null);
            return redirect()->route('pricing.index')->with('message','Data Deleted Successfully');
        }catch (Exception $e) {
            return redirect()->route('pricing.index')->with('error','Data Not Found');
        }
    }
}
