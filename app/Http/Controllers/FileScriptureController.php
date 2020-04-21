<?php

namespace App\Http\Controllers;

use App\Course;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FileScriptureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('scripture.view');
        try{
            $type = $request->query('type',1);
            $level = Course::all();
            $resources = Resource::where('course',$type)->where('type',1)->get();
        }catch (\Exception $e){
            Log::error('fileScripture.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.File.file_scripture',compact('type','level','resources'));
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
        $this->authorize('scripture.create');
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
            DB::rollBack();
            Log::error('fileScripture.store '.$e->getMessage());
            return back()->withErrors('新增錯誤');
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
     * @param \Illuminate\Http\Request $request
     * @param Resource $scripture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $scripture)
    {
        $this->authorize('scripture.update');
        $validatedData = $request->validate([
            'course' => 'required',
            'name' => 'required',
            'attr' => 'required',
        ]);
        try{
            DB::transaction(function ()use($validatedData,$scripture){
                $scripture->update($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('fileScripture.update '.$e->getMessage());
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
    public function destroy(Resource $scripture)
    {
        $this->authorize('scripture.delete');
        try{
            DB::transaction(function ()use($scripture){
                $scripture->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('fileScripture.destroy '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('刪除成功');
    }
}
