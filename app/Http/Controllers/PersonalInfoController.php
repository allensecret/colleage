<?php

namespace App\Http\Controllers;

use App\StudentData;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonalInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data = Auth::user();
        }catch (\Exception $e){
            Log::error('personalInfo.index '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view('Frontplatform.personalinfo',compact('data'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $personalInfo)
    {
        try{

        }catch (\Exception $e){
            Log::error('personalInfo.edit '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.personalinfo_modify',compact('personalInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $personalInfo)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ],[
            'required' => '「:attribute」為必填欄位'
        ]);
        $validatedStudentData = $request->validate([
            'dharma_name' => 'nullable',
            'gender' => 'required',
            'job' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
            'birthday' => 'nullable|date_format:Y/m/d',
            'language' => 'nullable',
            'nationality' => 'nullable',
            'skill' => 'nullable',
            'volunteer' => 'nullable'
        ],[
            'required' => '「:attribute」為必填欄位'
        ]);

        try{
            DB::transaction(function ()use($validatedData,$validatedStudentData,$personalInfo){
                $personalInfo->update($validatedData);
                $personalInfo->data->update($validatedStudentData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('personalInfo.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改失敗');
        }

        return redirect()->route('personalInfo.index')->with('success','修改成功');
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
