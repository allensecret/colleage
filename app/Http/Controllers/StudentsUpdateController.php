<?php

namespace App\Http\Controllers;

use App\CourseLevel;
use App\Curricula;
use App\Events\DownLevelEvent;
use App\Events\UpLevelEvent;
use App\StudentCurricula;
use App\StudentData;
use App\UpdateRecode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentsUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('students_update.view');
        try {
            $level = $request->query('level','');
            $option_level = CourseLevel::all();
            $curricula = Curricula::where([['level',$level],['report',1]])->orderBy('compulsory','asc')->get();
        }catch (\Exception $e) {
            Log::error('studentUpdate.index '.$e->getMessage());
            abort(403,'頁面錯誤！');
        }
        return view('MGplatform.StudentUpdate.students_update',compact('level','option_level','curricula'));
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
     * @param Request $request
     * @param $students_update
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$students_update)
    {
        $this->authorize('students_update.update');
        try{
            $selected = $request->selected;
            $status = $request->query('status',1);

            $list = User::whereHas('curriculas',function ($query)use($request){
                $query->whereIn('curricula',$request->selected);
            })->whereHas('data',function($query)use($students_update){
                $query->where('course_level',$students_update);
            })->get();

        }catch (\Exception $e){
            Log::error('studentUpdate.show '.$e->getMessage());
            return back();
        }
        return view('MGplatform.StudentUpdate.students_update_filter',compact('list','selected','students_update','status'));
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

    public function all_update(Request $request){
        $this->authorize('students_update.update');

        try{
            DB::transaction(function ()use($request){
                foreach ($request->update_list as $l){
                    $data = User::find($l);
                    //紀錄舊級別與學號
                    $old_level = $data->data->course_level;
                    $old_student_id = $data->account;
                    $new_level = CourseLevel::find($data->data->course_level + 1);//取得新年級的code

                    $data->encrypt = Crypt::encryptString($l);
                    $data->account = str_replace($data->data->level->code, $new_level->code, $data->account);  //修改學生年級與學號
                    $data->save();

                    StudentData::where('student',$l)->update(['course_level'=>$new_level->id]);

                    //新增升級紀錄
                    $recode = new UpdateRecode;
                    $recode->student = $l;
                    $recode->new_student_id = str_replace($data->data->level->code, $new_level->code, $data->account);
                    $recode->new_level = $new_level->id;
                    $recode->old_student_id = $old_student_id;
                    $recode->old_level = $old_level;
                    $recode->remark = '升級';
                    $recode->save();

                    //寄發升級郵件
                    event(new UpLevelEvent($l));
                }
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('studentUpdate.all_update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('失敗');
        }
        return back()->with('success','升級成功');
    }

    public function exception_update(User $id,Request $request){
        $this->authorize('students_update.update');
        try{
            DB::transaction(function ()use($id,$request) {
                //紀錄舊級別與學號
                $old_level = $id->data->course_level;
                $old_student_id = $id->account;
                //判斷升降級
                switch ($request->optradio) {
                    case "update":
                        //取得新年級的code
                        $new_level = CourseLevel::find($id->data->course_level+1);
                        //修改學生年級與學號
                        $id->student_id = str_replace($id->data->level->code,$new_level->code,$id->account);
                        $id->encrypt = Crypt::encryptString($id->id);
                        $id->save();

                        $id->data->save(new StudentData(['course_level'=>$new_level->id]));

                        $status_remark = "例外升級";
                        //寄發升級郵件
                        event(new UpLevelEvent($id->id));
                        break;
                    case "downgrade":
                        //取得新年級的code
                        $new_level = CourseLevel::find($id->data->course_level-1);
                        //修改學生年級與學號
                        $id->student_id = str_replace($id->data->level->code,$new_level->code,$id->account);
                        $id->save();

                        $id->data->save(new StudentData(['course_level'=>$new_level->id]));

                        //刪除報告

                        //刪除選課
                        StudentCurricula::where('student',$id->id)->whereHas('course',function ($query)use($old_level,$new_level){
                            $query->whereBetween('level',[$new_level->id,$old_level]);
                        })->delete();
                        $status_remark = "例外降級";
                        //寄發升級郵件
                        event(new DownLevelEvent($id->id));
                        break;
                }

                $recode = new UpdateRecode;
                $recode->student = $id->id;
                $recode->new_student_id = str_replace($id->data->level->code,$new_level->code,$id->account);
                $recode->new_level = $new_level->id;
                $recode->old_student_id = $old_student_id;
                $recode->old_level = $old_level;
                $recode->remark = $status_remark;
                $recode->save();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('studentUpdate.exception_update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('失敗');
        }
        return back()->with('success','成功升級');
    }

    //todo:寄發Email＆升級贈品網址
    public function keyin_exception_update(Request $request){
        $request->validate([
            'old_id' => 'required|check_student_id',
            'new_id' => 'required|check_level_code'
        ]);

        try{
            $old_level_code = CourseLevel::where('code',substr($request->old_id,0,2))->firstOrFail();
            $level_code = CourseLevel::where('code',substr($request->new_id,0,2))->firstOrFail();
            if($old_level_code->id > $level_code->id){
                $remark ='降級';
            }else{
                $remark ='升級';
            }
            DB::transaction(function ()use($request,$level_code,$old_level_code){
                if($old_level_code->id > $level_code->id){
                    //降級
                    $data = User::where('account', $request->old_id)->first();
                    $data->account = $request->new_id;
                    $data->save();

                    StudentData::where('student',$data->id)->update(['course_level'=>$level_code->id]);

                    //刪除報告


                    //刪除選課
                    StudentCurricula::where('student',$data->id)->whereHas('course',function ($query)use($old_level_code,$level_code){
                        $query->whereBetween('level',[$level_code->id,$old_level_code->id]);
                    })->delete();

                    $status_remark = "例外降級";

                    //寄發降級郵件
                    event(new DownLevelEvent($data->id));
                }else{
                    //升級
                    $data = User::where('account', $request->old_id)->first();
                    $data->account = $request->new_id;
                    $data->encrypt = Crypt::encryptString($data->id);
                    $data->save();

                    StudentData::where('student',$data->id)->update(['course_level'=>$level_code->id]);

                    $status_remark = "例外升級";

                    event(new UpLevelEvent($data->id));
                }

                $recode = new UpdateRecode;
                $recode->student = $data->id;
                $recode->new_student_id = $data->account;
                $recode->new_level = $level_code->id;
                $recode->old_student_id = $request->old_id;
                $recode->old_level = $old_level_code->id;
                $recode->remark = $status_remark;
                $recode->save();
            });

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('studentUpdate.keyin_exception_update '.$e->getMessage());
            return back()->withErrors($e->getMessage());
        }

        return back()->with('success','成功'.$remark);
    }
}
