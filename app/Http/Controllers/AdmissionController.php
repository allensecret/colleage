<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Course;
use App\CourseLevel;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdmissionController extends Controller
{
    public function time_rage(){
        $this_date = date('Y-m');
        $this_year = date('Y');
        $start = date("Y-m",strtotime($this_year."-04"));
        $end = date("Y-m",strtotime("+1 year",strtotime($this_year."-03")));

        if( strtotime($start) <= strtotime($this_date) && strtotime($end) >= strtotime($this_date) ){
            return $this_year;
        }else if( strtotime($start) > strtotime($this_date) ){
            return $this_year - 1;
        }
    }

    public function guide(){
        try{
            $data = Page::where('item','guidance')->first();
        }catch (\Exception $e){
            Log::error('Admission.guide '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.guide',compact('data'));
    }

    public function course_introduction(Request $request){
        try{
            $course = Course::all();
            $select_course = $request->select_course ?? 1;
            $course_content = Course::find($select_course);
            $course_level = CourseLevel::where('course',$select_course)->get();
        }catch (\Exception $e){
            Log::error('Admission.course_introduction '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }
        return view('Frontplatform.course_introduction',compact('course','select_course','course_content','course_level'));
    }

    public function calendar(){
        try{
            $year = null;
            if(getdate()['mon'] > 3){
                $year = getdate()['year'];
            }else{
                $year = getdate()['year']-1;
            }

            $data = Calendar::where('year',$this->time_rage())->orderBy('date','asc')->get();
        }catch (\Exception $e){
            Log::error('Admission.calendar '.$e->getMessage());
            abort('403','頁面資訊錯誤');
        }

        return view('Frontplatform.calendar',compact('year','data'));
    }
}
