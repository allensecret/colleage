<?php

namespace App\Http\Controllers;

use App\MailNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

//未使用的controller
class EmailController extends Controller
{
    public function drop_show(){
        try{
            $this->authorize('email_config_drop.view');
            $dropout = MailNotice::where('type','dropout_email_notice')->first();
            $dropin = MailNotice::where('type','dropin_email_notice')->first();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            abort(403,"頁面資訊錯誤！");
        }

        return view('MGplatform.MailConfig.mail_config_drop',compact('dropin','dropout'));
    }

    public function update_show(){
        try{
            $this->authorize('email_config_update.view');
            $data = MailNotice::where('type','update_email_notice')->first();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            abort(403,"頁面資訊錯誤！");
        }
        return view('MGplatform.MailConfig.mail_config_update',compact('data'));
    }

    public function enrollment_show(){
        try{
            $this->authorize('email_config_enrollment.view');
            $data = MailNotice::where('type','enrollment_email_notice')->first();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            abort(403,"頁面資訊錯誤！");
        }
        return view('MGplatform.MailConfig.mail_config_enrollment',compact('data'));
    }

    public function email_config(Request $request,$type){
        try{
            $data = MailNotice::where('type',$type)->first();
            if(empty($data)){
                $insert = new MailNotice;
                $insert->type = $type;
                $insert->content = $request->input('content');
                $insert->save();
            }else{
                $validatedData = $request->validate([
                    'content' => 'required',
                ]);
                $data->update($validatedData);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
        }
        return back();
    }
}
