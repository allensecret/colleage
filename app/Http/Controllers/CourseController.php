<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('course.view');
        try{
            $data = Course::all();
        }catch (\Exception $e){
            Log::error('course.index '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.Course.course',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('course.create');
        return view('MGplatform.Course.course_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('course.create');
        try{
            $validatedData = $request->validate([
                'name' => 'required|check_course_name',
                'intro' => 'required'
            ]);
            DB::transaction(function ()use($validatedData){
                Course::create($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('course.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('新增失敗');
        }
        return redirect()->route('course.index')->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $this->authorize('course.update');
        return view('MGplatform.Course.course_edit',compact('course'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->authorize('course.update');
        $validatedData = $request->validate([
            'name' => 'required',
            'intro' => 'required'
        ]);
        try{
            DB::transaction(function ()use($course,$validatedData){
                $course->update($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('course.udpate '.$e->getMessage());
            return back()->withErrors('修改錯誤');
        }

        return redirect()->route('course.index')->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Course $course)
    {
        $this->authorize('course.delete');
        try{
            DB::transaction(function ()use($course){
                $course->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('course.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }

        return back()->with('success','刪除成功');
    }
}
