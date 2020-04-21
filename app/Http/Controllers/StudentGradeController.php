<?php

namespace App\Http\Controllers;

use App\Events\FailedEvent;
use App\Report;
use App\StudentCurricula;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentGradeController extends Controller
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
            $this->authorize('students_grade.view');
            $request->flash();
            $search = $request->query('search',"");
            $data = User::where('account',$search)->first();
        }catch (\Exception $e){
            Log::error('students_grade.index '.$e->getMessage());
            abort(403,'頁面錯誤！');
        }
        return view('MGplatform.StudentGrade.students_grade',compact('data'));
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
     * @param Report $students_grade
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCurricula $students_grade)
    {
        $this->authorize('students_grade.update');
        return View('MGplatform.StudentGrade.students_grade_respond',compact('students_grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Report $students_grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCurricula $students_grade)
    {
        try{
            $this->authorize('students_grade.update');

            DB::transaction(function ()use($request,$students_grade){
                $students_grade->grade = $request->score;
                $students_grade->respond = $request->respond;
                if($request->score == "D" || $request->score == "E" || $request->score == "F"){
                    //不及格email回信，
                    event(new FailedEvent($students_grade));
                    $students_grade->done = 3;
                }else{
                    $students_grade->done = 2;
                }
                $students_grade->respond_date = date('Y-m-d');
                $students_grade->save();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('students_grade.update '.$e->getMessage());
            DB::rollBack();
            return redirect()->route('students_grade.index',['search'=>$students_grade->student_id->account])->withErrors('評分失敗');
        }
        return redirect()->route('students_grade.index',['search'=>$students_grade->student_id->account])->with('success','評分完成');
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
