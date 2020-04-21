<?php

namespace App\Http\Controllers;

use App\Merit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MeritMGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $this->authorize('merit.view');
            $data = Merit::get();
        }catch (\Exception $e){
            Log::error('meritMG.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('MGplatform.Merit.index',compact('data'));
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
        $this->authorize('merit.create');
        $validatedData = $request->validate([
            'name' => 'required',
            'file' => 'required|file|image|mimes:png,jpeg'
        ]);
        try{
            DB::transaction(function ()use($request){

                if($request->hasFile('file')){
                    $filename = $request->file('file')->getClientOriginalName();
                    $request->file('file')->storeAs('public/merit_img',$filename);
                }

                Merit::create(['name'=>$request->name,'img'=>$filename]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('meritMG.store '.$e->getMessage());
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
    public function update(Request $request, Merit $merit_MG)
    {
        $this->authorize('merit.update');
        $validatedData = $request->validate([
            'name' => 'required',
            'file' => 'required|file|image|mimes:png,jpeg'
        ]);

        try{
            DB::transaction(function ()use($request,$merit_MG){
                if($request->hasFile('file')){
                    $filename = $request->file('file')->getClientOriginalName();
                    $request->file('file')->storeAs('public/merit_img',$filename);
                    $merit_MG->update(['name'=>$request->name,'img'=>$filename]);
                }
                $merit_MG->update(['name'=>$request->name]);
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('meritMG.update '.$e->getMessage());
            return back()->withErrors('修改錯誤');
        }
        return back()->with('修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merit $merit_MG)
    {
        $this->authorize('merit.delete');
        try{
            DB::transaction(function ()use($merit_MG){
                $merit_MG->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('meritMG.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return back()->with('刪除成功');
    }
}
