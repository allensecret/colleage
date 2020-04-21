<?php

namespace App\Http\Controllers;

use App\Classes\txtRead;
use App\CurriculaMedia;
use App\DiscussionPost;
use App\Hosts;
use App\StudentCurricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('classroom.view');
        try{
            $host = $request->query('host',5);
            $host_attr = Hosts::find($host);
        }catch (\Exception $e){
            Log::error('classroom.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.classroom',compact('host','host_attr'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CurriculaMedia $classroom,Request $request)
    {
        try{
            $host = Hosts::find($request->host);
            $txt = new txtRead();
            $curricula = $request->curricula;
            $next_classroom = CurriculaMedia::where('course_data',$classroom->course_data)->where('ep',($classroom->ep+1))->first();
        }catch (\Exception $e){
            Log::error('classroom.show '.$e->getMessage());
        }

        return view('Frontplatform.classroom_video',compact('classroom','host','txt','curricula','next_classroom'));
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
    public function update(Request $request, StudentCurricula $classroom)
    {
        try{
            $done_ep = '';
            if($request->custom_done_ep != ''){
                foreach ($request->custom_done_ep as $d){
                    $done_ep .= $d.";";
                }
            }

            DB::transaction(function ()use($classroom,$done_ep){
                StudentCurricula::where('student',$classroom->student)->where('curricula',$classroom->curricula)->update(['done_ep'=> $done_ep]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('classroom.update '.$e->getMessage());
            return back()->withErrors('自訂完成課程失敗');
        }

        return redirect('/ST/classroom#'.$classroom->course->coursedata->sn)->with('success_'.$classroom->course->coursedata->sn,'自訂完成課程成功');
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

    public function share(Request $request){
        try{
            $share_report = DiscussionPost::where('type',5)->where('title','like','%'.$request->sn.'%')->get();
        }catch (\Exception $e){
            Log::error('classroom.share '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.classroom_share',compact('share_report'));
    }

    public function download_file(Request $request){
        try{
            $file_name = mb_split('/',$request->attr)[5];
            return response()->streamDownload(function ()use($request){
                echo file_get_contents($request->host.$request->attr);
            },$file_name);
        }catch (\Exception $e){
            Log::error('classroom.download_file '.$e->getMessage());
            return back();
        }
    }
}
