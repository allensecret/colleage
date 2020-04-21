<?php

namespace App\Http\Controllers;

use App\CourseLevel;
use App\Curricula;
use App\Events\UnreportMailEvent;
use App\Mail\NoticeFormMail;
use App\Report;
use App\StudentCurricula;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UnreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $s_level = $request->level;
            $s_curricula = $request->curricula;
            //下拉選項
            $level = CourseLevel::all();
            $curricula = Curricula::where([['level',$s_level],['report',1]])->get();
            //資料
            $data = StudentCurricula::where('curricula',$s_curricula)->whereIn('done',[0,3])->get();

        }catch (\Exception $e){
            Log::error('unreport.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.WorkGrade.work_grade_unreport',compact('s_level','s_curricula','level','curricula','data'));
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

    //發送個人通知催繳作業信件
    public function mail_notice(Request $request){
        try{
            event(new UnreportMailEvent($request->all()));

        }catch (\Exception $e){
            Log::error('unreport.mail_notice '.$e->getMessage());
            return back()->withErrors('發信失敗');
        }
        return back()->with('success','發信成功');
    }
    //發送全體通知催繳作業信件
    public function all_mail_notice(Request $request){
        try{
            $data = StudentCurricula::where('curricula',$request->data)->whereIn('done',[0,3])->get();
            foreach ($data as $d){
                event(new UnreportMailEvent(['student'=>$d->get_student->account,'sn_course'=>$d->course->coursedata->sn,'course'=>$d->course->coursedata->title]));
            }
        }catch (\Exception $e){
            Log::error('unreport.all_mail_notice '.$e->getMessage());
            return back()->withErrors('發信失敗');
        }

        return back()->with('發信成功');
    }
}
