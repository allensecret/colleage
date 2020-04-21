<?php

namespace App\Http\Controllers;

use App\Page;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IntroductionController extends Controller
{
    public function introduction(){
        try{
            $data = Page::where('item','like','%understanding%')->get();
        }catch (\Exception $e){
            Log::error('Introduction.introduction '.$e->getMessage());
            abort(403,'頁面資訊錯誤');
        }
        return view("Frontplatform.introduction",compact('data'));
    }

    public function teacher_introduction(){
        try{
            $teacher = Teacher::all();
        }catch (\Exception $e){
            Log::error('Introduction.teacher_introduction '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.teacher_introduction',compact('teacher'));
    }

    public function teacher_introduction_detail(Teacher $teacher){

        return view('Frontplatform.teacher_introduction_detail',compact('teacher'));
    }
}
