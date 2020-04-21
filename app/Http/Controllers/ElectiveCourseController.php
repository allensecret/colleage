<?php

namespace App\Http\Controllers;

use App\Config;
use App\Curricula;
use App\Events\ElectiveEvent;
use App\Report;
use App\StudentCurricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ElectiveCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('elective_course.view');
        try{
            $config = Config::where('title','elective')->first();
            $curricula = Curricula::where('level',Auth::user()->data->course_level)->whereNotIn('id',Auth::user()->curriculas->pluck('curricula'))->get();
            $has_curricula = Curricula::where('level',Auth::user()->data->course_level)->whereIn('id',Auth::user()->curriculas->pluck('curricula'))->get();
        }catch (\Exception $e){
            Log::error('elective_course.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('Frontplatform.elective_course',compact('config','curricula','has_curricula'));
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
        try{
            $config = Config::where('title','elective')->first();
            if($config->config == 1){
                DB::transaction(function ()use($request){
                    if(!empty($request->course)){
                        $course = $request->course;
                    }else{
                        $course = [];
                    }
                    foreach ($course as $c){
                        StudentCurricula::create(['student'=>Auth::user()->id,'curricula'=>$c]);
                    }
                });
                DB::commit();
                event(new ElectiveEvent(Auth::user()->id));
            }
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('elective_course.store '.$e->getMessage());
            return back()->withErrors('選課錯誤');
        }
        return back()->with('選課成功');
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
    public function destroy($elective_course)
    {
        try{
            DB::transaction(function ()use($elective_course){
                StudentCurricula::where('student',Auth::user()->id)->where('curricula',$elective_course)->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }
}
