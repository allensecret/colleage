<?php

namespace App\Http\Controllers;

use App\Merit;
use App\MeritGrade;
use App\MeritItem;
use App\Page;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MeritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('st_merit.view');
        try{
            $data = Merit::all();
        }catch (\Exception $e){
            Log::error('st_merit.index '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.merit',compact('data'));
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
        try{
            DB::transaction(function ()use($request){
                $merit = MeritItem::where('merit',$request->merit)->whereNull('student')->count();
                $student_merit = MeritItem::where('merit',$request->merit)->where('student',Auth::user()->id)->count();

                $total = $merit+$student_merit;
                if(is_array($request->check_item)){
                    $check = count($request->check_item);

                    $no_merit_check = MeritItem::where('merit',$request->merit)->whereNull('student')->whereNotIn('id',$request->check_item)->pluck('id');
                    $no_student_merit_check = MeritItem::where('merit',$request->merit)->where('student',Auth::user()->id)->whereNotIn('id',$request->check_item)->pluck('id');

                    $check_ok = '';$check_no = '';

                    foreach ($request->check_item as $i){
                        $check_ok .= $i.";";
                    }
                    foreach ($no_merit_check as $n){
                        $check_no .= $n.";";
                    }
                    foreach ($no_student_merit_check as $n){
                        $check_no .= $n.";";
                    }

                    MeritGrade::create([
                        'merit'=>$request->merit,
                        'student'=>Auth::user()->id,
                        'grade'=>round(($check/$total) * 100),
                        'yes' => $check_ok,
                        'no' => $check_no
                    ]);

                }else{
                    $no_merit_check = MeritItem::where('merit',$request->merit)->whereNull('student')->pluck('id');
                    $no_student_merit_check = MeritItem::where('merit',$request->merit)->where('student',Auth::user()->id)->pluck('id');

                    $check_ok = '';$check_no = '';

                    foreach ($no_merit_check as $n){
                        $check_no .= $n.";";
                    }
                    foreach ($no_student_merit_check as $n){
                        $check_no .= $n.";";
                    }

                    MeritGrade::create([
                        'merit'=>$request->merit,
                        'student'=>Auth::user()->id,
                        'grade'=>0,
                        'yes' => $check_ok,
                        'no' => $check_no
                    ]);
                }
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('st_merit.store '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('提交錯誤');
        }
        return redirect()->route('merit.ration',['merit'=>$request->merit])->with('success','今日功課提交完成');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Merit $merit)
    {
        $this->authorize('st_merit.view');
        try{
            $date = MeritGrade::where('merit',$merit->id)->where('student',Auth::user()->id)->get()->last();
        }catch (\Exception $e){
            Log::error('st_merit.show '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.merit_content',compact('merit','date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MeritGrade $merit)
    {
        try{
            $data = Merit::find($merit->merit);
            $student_date = MeritGrade::where('merit',$merit->id)->where('student',Auth::user()->id)->get();
        }catch (\Exception $e){
            Log::error('st_merit.edit '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.merit_edit',compact('merit','data','student_date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merit $merit)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ],[
            'required'=>'不可空白'
        ]);
        try{
            DB::transaction(function ()use($merit,$request){
                MeritItem::create(['merit'=>$merit->id,'item'=>$request->name,'student'=>Auth::user()->id]);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('st_merit.update '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('新增功課錯誤');
        }
        return back()->with('success','新增功課成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 刪除新增功課
     */
    public function destroy(MeritItem $merit)
    {
        try{
            DB::transaction(function ()use($merit){
                $merit->delete();
            });
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('st_merit.destroy '.$e->getMessage());
            return back()->withErrors('刪除錯誤');
        }
        return back()->with('success','刪除成功');
    }

    public function merit_update(Request $request,MeritGrade $meritGrade){
        try{
            DB::transaction(function ()use($request,$meritGrade){
                $merit = MeritItem::where('merit',$meritGrade->merit)->whereNull('student')->count();
                $student_merit = MeritItem::where('merit',$meritGrade->merit)->where('student',Auth::user()->id)->count();

                $total = $merit+$student_merit;
                if(is_array($request->check_item)) {
                    $check = count($request->check_item);

                    $no_merit_check = MeritItem::where('merit',$meritGrade->merit)->whereNull('student')->whereNotIn('id',$request->check_item)->pluck('id');
                    $no_student_merit_check = MeritItem::where('merit',$meritGrade->merit)->where('student',Auth::user()->id)->whereNotIn('id',$request->check_item)->pluck('id');

                    $check_ok = '';$check_no = '';

                    foreach ($request->check_item as $i){
                        $check_ok .= $i.";";
                    }
                    foreach ($no_merit_check as $n){
                        $check_no .= $n.";";
                    }
                    foreach ($no_student_merit_check as $n){
                        $check_no .= $n.";";
                    }

                    $meritGrade->update([
                        'grade'=>round(($check/$total) * 100),
                        'yes' => $check_ok,
                        'no' => $check_no
                    ]);
                }else{
                    $check = 0;

                    $no_merit_check = MeritItem::where('merit',$meritGrade->merit)->whereNull('student')->pluck('id');
                    $no_student_merit_check = MeritItem::where('merit',$meritGrade->merit)->where('student',Auth::user()->id)->pluck('id');

                    $check_ok = '';$check_no = '';

                    foreach ($no_merit_check as $n){
                        $check_no .= $n.";";
                    }
                    foreach ($no_student_merit_check as $n){
                        $check_no .= $n.";";
                    }

                    $meritGrade->update([
                        'grade'=>0,
                        'yes' => $check_ok,
                        'no' => $check_no
                    ]);
                }

            });
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            Log::error('st_merit.merit_update '.$e->getMessage());
            return back()->withErrors('提交錯誤');
        }
        return redirect()->route('merit.ration',['merit'=>$meritGrade->merit])->with('success','修改成功');
    }

    public function rule(){
        $this->authorize('st_merit.view');
        try{
            $data = Page::where('item','merit_rule')->first();
        }catch (\Exception $e){
            Log::error('st_merit.rule '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.merit_rule',compact('data'));
    }

    public function explanation(){
        $this->authorize('st_merit.view');
        try{
            $data = Page::where('item','merit_explanation')->first();
        }catch (\Exception $e){
            Log::error('st_merit.explanation '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.merit_explanation',compact('data'));
    }

    public function ration(Request $request){
        $this->authorize('st_merit.view');
        try{
            $merit = Merit::find($request->merit);
            $data = MeritGrade::where('merit',$request->merit)->where('student',Auth::id())->get();
        }catch (\Exception $e){
            Log::error('st_merit.ration '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.merit_ration',compact('merit','data'));
    }
}
