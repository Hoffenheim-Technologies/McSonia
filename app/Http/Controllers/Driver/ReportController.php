<?php

namespace App\Http\Controllers\Driver;

use App\Constants\UserActivityConstants;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\Activity\User\UserActivityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('driver.report.index', compact('reports'));
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
                $data['description'] = $request->description;
                $data['user_id'] = $user->id;
                $data['category'] = $request->category;
                $data['reference_id'] = $request->reference_id ?? null;
                Report::create($data);
                UserActivityService::log($user->id,UserActivityConstants::REPORT_ACTIVITY,"Report Create","User Created $request->category Report",null);
                DB::commit();
                return redirect()->back()->with('message','Data Created Successfully');

        }catch (Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()->with('error','Unable to Add');
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
