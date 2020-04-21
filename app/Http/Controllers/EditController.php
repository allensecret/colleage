<?php

namespace App\Http\Controllers;

use App\Config;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditController extends Controller
{
    //入學指導
    public function admission_guidance(){
        try{
            $this->authorize('edit_admission_guidance.view');
            $data = Page::where('item','guidance')->first();
        }catch (\Exception $e){
            Log::error('edit.admission_guidance '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.EditPage.edit_admission_guidance',compact('data'));
    }

    //教學計畫
    public function plan(){
        try{
            $this->authorize('edit_plan.view');
            $data = Page::where('item','plan')->first();
        }catch (\Exception $e){
            Log::error('edit.plan '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.EditPage.edit_plan',compact('data'));
    }

    //認識學院
    public function understanding(Request $request){
        try{
            $this->authorize('edit_understanding.view');
            $type = $request->query('type','understanding_origin');
            $data = Page::where('item',$type)->first();
        }catch (\Exception $e){
            Log::error('edit.understanding '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.EditPage.edit_understanding',compact('data','type'));
    }

    //說明看板
    public function description(){
        try{
            $this->authorize('edit_description.view');
            $classification = Page::where('item','classification')->first();
            $precautions = Page::where('item','precautions')->first();
        }catch (\Exception $e){
            Log::error('edit.description '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.EditPage.edit_description',compact('classification','precautions'));
    }

    //重要通知
    public function announcement(){
        try{
            $this->authorize('edit_announcement.view');
            $config = Config::where('title','announcement')->first();
            $data = Page::where('item','announcement')->first();
        }catch (\Exception $e){
            Log::error('edit.announcement '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }
        return view('MGplatform.EditPage.edit_announcement',compact('config','data'));
    }

    //功過格-修行守則
    public function merit_rule(){
        try{
            $this->authorize('edit_merit_rule.view');
            $config = Config::where('title','merit_rule')->first();
            $data = Page::where('item','merit_rule')->first();
        }catch (\Exception $e){
            Log::error('edit.merit_rule '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }

        return view('MGplatform.EditPage.edit_merit_rule',compact('config','data'));
    }

    //功過格-使用說明
    public function merit_explanation(){
        try{
            $this->authorize('edit_merit_explanation.view');
            $config = Config::where('title','merit_explanation')->first();
            $data = Page::where('item','merit_explanation')->first();
        }catch (\Exception $e){
            Log::error('edit.merit_explanation '.$e->getMessage());
            abort(403,'頁面資訊錯誤！');
        }

        return view('MGplatform.EditPage.edit_merit_explanation',compact('config','data'));
    }

    public function edit(Request $request,$type){
        try{
            DB::transaction(function ()use($request,$type){
                $check = Page::where('item',$type)->first();
                if(empty($check)){
                    $data = new Page();
                    $data->item = $type;
                    $data->content = $request->input('content');
                    switch ($type){
                        case "understanding_intro":
                            $data->remark = '認識學院_簡介';
                            break;
                        case "understanding_origin":
                            $data->remark = '認識學院_成立緣起';
                            break;
                        case "understanding_purpose":
                            $data->remark = '認識學院_教學宗旨';
                            break;
                        case "understanding_teach":
                            $data->remark = '認識學院_學院院訓';
                            break;
                        case "understanding_way":
                            $data->remark = '認識學院_教學方式';
                            break;
                        case "understanding_introduction":
                            $data->remark = '認識學院_修學介紹';
                            break;
                        case "understanding_future":
                            $data->remark = '認識學院_未來展望';
                            break;
                        case "guidance":
                            $data->remark = '入學指導';
                            break;
                        case "plan":
                            $data->remark = '教學計劃';
                            break;
                        case "classification":
                            $data->remark = "說明看板-分類說明";
                            break;
                        case "precautions":
                            $data->remark = "說明看板-注意事項";
                            break;
                        case "announcement":
                            $data->remark = '重要通知';
                            break;
                        case "merit_rule":
                            $data->remark = '功過格-修行守則';
                            break;
                        case "merit_explanation":
                            $data->remark = '功過格-使用說明';
                            break;
                    }
                    $data->save();
                }else{
                    $check->update(['content'=>$request->input('content')]);
                }
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('edit.edit '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('修改錯誤');
        }
        return back()->with('success','修改成功');
    }


    public function announcement_mange(Request $request,Config $config){
        $validatedData = $request->validate([
            'config' => 'required',
        ]);
        try{
            DB::transaction(function ()use($config,$validatedData){
                $config->update($validatedData);
            });
            DB::commit();
        }catch (\Exception $e){
            Log::error('edit.announcement_mange '.$e->getMessage());
            DB::rollBack();
            return back()->withErrors('設定錯誤');
        }
        return back()->with('success','設定成功');
    }
}
