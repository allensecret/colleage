<?php

namespace App\Http\Controllers;

use App\BlackList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlackListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('blacklist.view');
        try{
            $data = Blacklist::all();
        }catch (\Exception $e){
            Log::error('BlackList.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.BlackList.students_black_list',compact('data'));
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
        $this->authorize('blacklist.create');
        $validatedData = $request->validate([
            'account' => 'required|check_student_id'
        ]);
        try{
            DB::transaction(function ()use($request){
                $check = User::where('account',$request->account)->firstOrFail();
                $data = new Blacklist;
                $data->student = $check->id;
                $data->save();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('BlackList.store '.$e->getMessage());
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
     * @param BlackList $black_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blacklist $black_list)
    {
        $this->authorize('blacklist.delete');
        try{
            DB::transaction(function ()use($black_list){
                $black_list->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('BlackList.destroy '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('success','刪除成功');
    }
}
