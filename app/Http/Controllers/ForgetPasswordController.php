<?php

namespace App\Http\Controllers;

use App\Events\ForgetPasswordEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ForgetPasswordController extends Controller
{
    public function view(){
        return view('Frontplatform.forgetpassword');
    }

    public function send(Request $request){
        $request->validate([
            'student_email' => 'required|check_email'
        ],[
            'check_email' => '郵件信箱不存在'
        ]);

        try{
            $data = User::where('email',$request->student_email)->first();
            event(new ForgetPasswordEvent($data->id));
        }catch (\Exception $e){
            Log::error('forgetPassword.send '.$e->getMessage());
            return back()->withErrors('程序錯誤');
        }
        return back()->with(['email'=>$data->email,'account'=>$data->account]);
    }
}
