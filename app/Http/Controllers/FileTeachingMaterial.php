<?php

namespace App\Http\Controllers;

use App\Course;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FileTeachingMaterial extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('teaching_material.view');
        try{
            $type = $request->query('type',1);
            $level = Course::all();
            $resources = Resource::where('course',$type)->where('type',2)->get();
        }catch (\Exception $e){
            Log::error('FileTeaching.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.File.file_teaching_material',['level'=>$level,'type'=>$type,'resources'=>$resources]);
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
        $this->authorize('teaching_material.create');
        $validatedData = $request->validate([
            'course' => 'required',
            'name' => 'required',
            'attr' => 'required',
            'type' => 'required'
        ]);
        try{
            DB::transaction(function ()use($validatedData){
                Resource::create($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('FileTeaching.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('新增失敗');
        }
        return back()->with('新增成功');
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
    public function update(Request $request,Resource $teaching_material)
    {
        $this->authorize('teaching_material.update');
        $validatedData = $request->validate([
            'course' => 'required',
            'name' => 'required',
            'attr' => 'required',
        ]);
        try{
            DB::transaction(function ()use($validatedData,$teaching_material){
                $teaching_material->update($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('FileTeaching.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改錯誤');
        }

        return back()->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $teaching_material)
    {
        $this->authorize('teaching_material.delete');
        try{
            DB::transaction(function ()use($teaching_material){
                $teaching_material->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('FileTeaching.destroy '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('刪除成功');
    }
}
