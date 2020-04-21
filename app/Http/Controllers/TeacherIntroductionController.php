<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeacherIntroductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('edit_teacher.view');
        try{
            $teacher = Teacher::all();
        }catch (\Exception $e){
            Log::error('teacherIntroduction.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.EditPage.teacher_introduction.index',compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MGplatform.EditPage.teacher_introduction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('edit_teacher.create');

        $request->validate([
            'name' => 'required',
            'img' => 'required|image:png,jpeg',
            'introduction'=> 'required'
        ],[
            'required' => '必填欄位',
        ]);
        try{
            DB::transaction(function ()use($request){
                if($request->hasFile('img')){
                    $filename = $request->file('img')->getClientOriginalName();
                    $extension = $request->file('img')->getClientOriginalExtension();
                    $request->file('img')->storeAs('public/img',$filename);
                }

                $teacher = new Teacher;
                $teacher->name = $request->name;
                if($request->hasFile('img')){
                    $teacher->img = $filename;
                }
                $teacher->attr = json_encode($request->attr);
                $teacher->introduction = $request->introduction;
                $teacher->save();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('teacherIntroduction.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('新增錯誤');
        }

        return redirect()->route('teacher_introduction.index')->with('success','新增成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher_introduction)
    {
        $this->authorize('edit_teacher.view');
        try{
            $teacher = $teacher_introduction;
        }catch (\Exception $e){
            Log::error('teacherIntroduction.show '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view('MGplatform.EditPage.teacher_introduction.show',compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher_introduction)
    {
        $this->authorize('edit_teacher.update');
        try{
            $teacher = $teacher_introduction;
        }catch (\Exception $e){
            Log::error('teacherIntroduction.edit '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view('MGplatform.EditPage.teacher_introduction.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher_introduction)
    {
        $this->authorize('edit_teacher.update');

        $request->validate([
            'name' => 'required',
            'img' => 'image|mimes:png,jpeg',
            'introduction'=> 'required'
        ],[
            'required' => '必填欄位',
        ]);

        try{
            DB::transaction(function ()use($request,$teacher_introduction){
                if($request->hasFile('img')){
                    Storage::delete(['public/img/'.$teacher_introduction->img]);

                    $filename = $request->file('img')->getClientOriginalName();
                    $request->file('img')->storeAs('public/img',$filename);
                    $teacher_introduction->update(['name'=>$request->name,'img'=>$filename,'attr'=>json_encode($request->attr),'introduction'=>$request->introduction]);
                }else{
                    $teacher_introduction->update(['name'=>$request->name,'attr'=>json_encode($request->attr),'introduction'=>$request->introduction]);
                }
            });
            DB::rollBack();
        }catch (\Exception $e){
            Log::error('teacherIntroduction.update '.$e->getMessage());
            return back()->withErrors('修改錯誤');
        }

        return redirect()->route('teacher_introduction.show',['teacher_introduction'=>$teacher_introduction])->with('修改正確');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher_introduction)
    {
        $this->authorize('edit_teacher.delete');
        try{
            DB::transaction(function ()use($teacher_introduction){
                Storage::delete(['public/img/'.$teacher_introduction->img]);
                $teacher_introduction->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('teacherIntroduction.destroy '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除失敗');
        }
        return back()->with('success','刪除成功');
    }
}
