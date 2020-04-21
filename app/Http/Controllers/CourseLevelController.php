<?php

namespace App\Http\Controllers;

use App\Classes\toChineseNumber;
use App\Course;
use App\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('course_level.view');
        try{
            $data = Course::all();
        }catch (\Exception $e){
            Log::error('course_level.index '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.Course_level.course_level',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('course_level.create');
        try{
            DB::transaction(function ()use($request){
                $num2Zh = new toChineseNumber();
                switch (Course::find($request->course)->name){
                    case "基礎學科":
                        $level = "基礎班".$num2Zh->num2zh(CourseLevel::where('course',$request->course)->count() + 1)."年級";
                        break;
                    case "本科學科":
                        $level = "本科班".$num2Zh->num2zh(CourseLevel::where('course',$request->course)->count() + 1)."年級";
                        break;
                    case "專科學科":
                        $level = "專科班".$num2Zh->num2zh(CourseLevel::where('course',$request->course)->count() + 1)."年級";
                        break;
                }
                $Course_level = new CourseLevel();
                $Course_level->course = $request->course;
                $Course_level->level = $level;
                $Course_level->code = 'e'.chr(ord(substr(CourseLevel::where('course',$request->course)->get()->last()->code,1,2))+1);
                $Course_level->save();
            });

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('course_level.create '.$e->getMessage());
            return back()->withErrors('建立錯誤');
        }
        return back()->with('success','建立成功');
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
     * @param CourseLevel $course_level
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(CourseLevel $course_level)
    {
        $this->authorize('course_level.delete');
        try{
            DB::transaction(function ()use($course_level){
                $course_level->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('course_level.destroy '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除失敗');
        }

        return back()->with('success','刪除成功');
    }
}
