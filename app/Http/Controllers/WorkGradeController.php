<?php

namespace App\Http\Controllers;

use App\CourseLevel;
use App\Curricula;
use App\DiscussionPost;
use App\DiscussionReplies;
use App\Events\FailedEvent;
use App\Report;
use App\StudentCurricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('work_grade.view');
        try{
            $status = $request->query('status','');
            $s_level = $request->query('level',1);
            $s_curricula = $request->query('curriculum',2);

            $level = CourseLevel::all();
            $curricula = Curricula::where([['level',$s_level],['report',1]])->get();
            $query = StudentCurricula::query();
            $query->where('curricula',$s_curricula);
            switch ($status) {
                case "1"://未審核
                    $query->where('done',1);
                    break;
                case "2"://已審核
                    $query->where('done',2);
                    break;
                case "3"://審核未過
                    $query->where('done',3);
                    break;
                default:
                    $query->whereIn('done',[1,2,3]);
            }
            $report = $query->paginate(30)->setpath('');
            $report->appends(['level'=>$s_level,'curriculum'=>$s_curricula,'status'=>$status]);
        }catch (\Exception $e){
            Log::error('workGrade '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.WorkGrade.work_grade',compact('status','curricula','s_level','s_curricula','level','report'));
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
     * @param Report $work_grade
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCurricula $work_grade)
    {
        $this->authorize('work_grade.update');
        return view('MGplatform.WorkGrade.work_grade_respond',compact('work_grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Report $work_grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCurricula $work_grade)
    {
        $this->authorize('work_grade.update');

        try{
            DB::transaction(function ()use($request,$work_grade){
                $work_grade->grade = $request->score;
                $work_grade->respond = $request->respond;
                if($request->score == "D" || $request->score == "E" || $request->score == "F"){
                    //不及格email回信，
                    event(new FailedEvent($work_grade));
                    $work_grade->done = 3;
                }else{
                    $work_grade->done = 2;
                }
                $work_grade->respond_date = date('Y-m-d');
                $work_grade->save();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('workGrade.update '.$e->getMessage());
            DB::rollBack();
            return redirect()->route('work_grade.index',['level'=>$request->level,'curriculum'=>$request->curricula])->withErrors('評分失敗');
        }
        return redirect()->route('work_grade.index',['level'=>$request->level,'curriculum'=>$request->curricula])->with('success','評分成功');
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

    public function shear(Report $report){
        try{
            DiscussionPost::create([
                'type'=> 5,
                'student' => $report->student,
                'title' => $report->course->coursedata->sn.$report->course->coursedata->title,
                'content' => $report->content
            ]);
        }catch (\Exception $e){
            Log::error('work_grade.shear '.$e->getMessage());
            return back()->withErrors('分享失敗');
        }

        return back()->with('success','成功分享報告至欣賞修學報告');

    }
}
