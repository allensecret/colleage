<?php

namespace App\Http\Controllers;

use App\Config;
use App\StudentCurricula;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupElectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('sup_elective.view');

        try{
            $search = $request->query('search','');
            $config = Config::where('title','elective')->first();
            $data = User::where('account',$search)->first();
        }catch (\Exception $e){
            Log::error('supElective.index '.$e->getMessage());
            abort(403,'頁面錯誤.');
        }
        return view('MGplatform.SupElective.sup_elective_course',compact('config','data'));
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
        $this->authorize('sup_elective.create');
        try{

            DB::transaction(function ()use($request){
                StudentCurricula::create(['student'=>$request->student,'curricula'=>$request->id]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('supElective.store '.$e->getMessage());
            DB::rollBack();
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
     * @param Config $sup_elective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $sup_elective)
    {
        $this->authorize('sup_elective.update');
        try{
            DB::transaction(function ()use($request,$sup_elective){
                $sup_elective->update(['config'=>$request->config]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('supElective.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改錯誤');
        }
        return back()->with('新改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StudentCurricula $sup_elective
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCurricula $sup_elective)
    {
        $this->authorize('sup_elective.delete');
        try{
            DB::transaction(function ()use($sup_elective){
                $sup_elective->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('supElective.update '.$e->getMessage());
            DB::rollBack();
        }
        return back();
    }
}
