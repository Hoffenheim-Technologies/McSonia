<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at','DESC')->get();
        return view("admin.testimonial.index", compact('testimonials'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['comment'] = $request->comment;
            $data['rating'] = $request->rating;

            Testimonial::create($data);
            DB::commit();
            UserActivityService::log($user->id,UserActivityConstants::TESTIMONIAL_ACTIVITY,"Testimonial Created","User Added Client Testimonial",null);
            return redirect()->route('testimonials.index')->with('message','Data Created Successfully');

        }catch(Exception $as){
            DB::rollback();
            dd($as);
            return redirect()->route('testimonials.index')->with('error','Data Entry Unsuccessful, Check Values');
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
            DB::beginTransaction();
            $testimonial = Testimonial::find($id);
            if(!empty($testimonial)){
                $testimonial->delete();
                DB::commit();
                UserActivityService::log($user->id,UserActivityConstants::TESTIMONIAL_ACTIVITY,"Testimonial Deleted","User Deleted Client Testimonial",null);
                return redirect()->route('testimonials.index')->with('message','Data Deleted Successfully');
            }
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->route('testimonials.index')->with('error','Unable To Delete');
            dd($e);
        }
    }
}
