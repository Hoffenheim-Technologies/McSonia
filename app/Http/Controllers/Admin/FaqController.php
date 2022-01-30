<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserActivityConstants;
use App\Http\Requests\StorefaqRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatefaqRequest;
use App\Models\faq;
use App\Models\User;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = faq::orderBy('created_at','ASC')->get();
        return view("admin.faq.index", compact('faqs'));
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
            $data['question'] = $request->question;
            $data['answer'] = $request->answer;

            faq::create($data);
            DB::commit();
            UserActivityService::log($user->id,UserActivityConstants::FAQ_ACTIVITY,"FAQ Created","User Added FAQ",null);
            return redirect()->route('faqs.index')->with('message','Data Created Successfully');

        }catch(Exception $as){
            DB::rollback();
            dd($as);
            return redirect()->route('faqs.index')->with('error','Data Entry Unsuccessful, Check Values');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(faq $faq)
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
            $faq = faq::find($id);
            if(!empty($faq)){
                $data = [];
                $faq->question = $request->question;
                $faq->answer = $request->answer;
                $faq->save();
                UserActivityService::log($user->id,UserActivityConstants::FAQ_ACTIVITY,"FAQ Update","User Updated FAQ",$data);
                DB::commit();
                return redirect()->route('faqs.index')->with('message','Data Updated Successfully');
            }
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->route('faqs.index')->with('error','Unable to update');
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
        $user = Auth::user();
        try {
            $faq = faq::find($id);
        if(!empty($faq)){
            $faq->delete();
            UserActivityService::log($user->id,UserActivityConstants::FAQ_ACTIVITY,"FAQ Deleted","User Deleted FAQ",null);
            return redirect()->route('faqs.index')->with('message','Data Deleted Successfully');
        }
        }catch (Exception $e) {
            dd($e);
        }
    }
}
