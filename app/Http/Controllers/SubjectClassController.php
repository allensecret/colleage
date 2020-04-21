<?php

namespace App\Http\Controllers;

use App\CourseData;
use App\CourseLevel;
use App\Curricula;
use App\Rules\Check_Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubjectClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('subject_class.view');

        try{
            $id = $request->query('class',1);
            $level = CourseLevel::all();
            $data = CourseLevel::find($id);
            $course = CourseData::all();
        }catch (\Exception $e){
            Log::error('subjectClass.index '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.Subject_class.subject_class',compact('level','data','course','id'));
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
        $this->authorize('subject_class.create');
        $validatedData = $request->validate([
            'level' => 'required',
            'course_data' => ['required',new Check_Course($request->level)],
            'report' => 'required',
            'compulsory' => 'required',
            'remark' => 'nullable',
            'report_maximum' => 'nullable'
        ]);
        try{
            DB::transaction(function ()use($validatedData){
                Curricula::create($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('subjectClass.store '.$e->getMessage());
            return back()->withErrors('新增錯誤');
        }
        return back()->with('success','新增成功');
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
     * @param  \Illuminate\Http\Request $request
     * @param Curricula $subject_class
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curricula $subject_class)
    {
        $this->authorize('subject_class.update');
        $validatedData = $request->validate([
            'level' => 'required',
            'course_data' => 'required',
            'report' => 'required',
            'compulsory' => 'required',
            'remark' => 'nullable',
            'report_maximum' => 'nullable'
        ]);
        try{
            DB::transaction(function ()use($validatedData,$subject_class){
                $subject_class->update($validatedData);
            });

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('subjectClass.update '.$e->getMessage());
            return back()->withErrors('修改錯誤');
        }
        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Curricula $subject_class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curricula $subject_class)
    {
        $this->authorize('subject_class.delete');
        try{
            DB::transaction(function ()use($subject_class){
                $subject_class->student_curricula()->delete();
                $subject_class->delete();
            });

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('subjectClass.destroy '.$e->getMessage());
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('success','刪除成功');
    }

}
