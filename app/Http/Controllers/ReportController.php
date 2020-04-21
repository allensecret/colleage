<?php

namespace App\Http\Controllers;

use App\Report;
use App\StudentCurricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('report.view');
        try{
            //do something
        }catch (\Exception $e){
            Log::error('report.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.report');
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
        $report = StudentCurricula::find($request->curricula);

        $validatedData = $request->validate([
            'content' => 'required|check_text|Maximum:'.$report->course->report_maximum
        ],[
            'required' => '必填欄位',
            'check_text' => '必填欄位',
            'maximum' => '字數不足,需滿足'.$report->course->report_maximum.'字',
        ]);

        try{
            $request->flush();
            $report->update([
                'content' => $request->input('content'),
                'done'=>1,
                'report_date' => date('Y-m-d')
            ]);

        }catch (\Exception $e){
            Log::error('report.update '.$e->getMessage());
            return back()->withErrors('提交失敗');
        }
        return redirect()->route('report.index')->with('success','提交成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StudentCurricula $report)
    {
        try{

        }catch (\Exception $e){
            Log::error('report.show '.$e->getMessage());
        }
        return view('Frontplatform.report_refer',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentCurricula $report)
    {
        try{

        }catch (\Exception $e){
            Log::error('report.edit '.$e->getMessage());
        }
        return view('Frontplatform.report_edit',compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentCurricula $report)
    {
        $validatedData = $request->validate([
            'content' => 'required|check_text|Maximum:'.$report->course->report_maximum
        ],[
            'required' => '必填欄位',
            'check_text' => '必填欄位',
            'maximum' => '字數不足,需滿足'.$report->course->report_maximum.'字',
        ]);

        try{
            $request->flush();
            $report->update([
                'content' => $request->input('content'),
                'done'=>1,
                'report_date' => date('Y-m-d')
            ]);

        }catch (\Exception $e){
            Log::error('report.update '.$e->getMessage());
            return back()->withErrors('提交失敗');
        }
        return redirect()->route('report.index')->with('success','提交成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentCurricula $report)
    {
        try{
            DB::transaction(function ()use($report){
                $report->update([
                    'content' => null,
                    'done' => 0,
                    'report_date' => null
                ]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('report.destroy '.$e->getMessage());
            return back()->withErrors('刪除失敗');
        }
        return redirect()->route('report.index')->with('刪除成功');
    }
}
