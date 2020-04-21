<?php

namespace App\Http\Controllers;


use App\CourseData;
use App\Curricula;

use App\Report;
use App\StudentCurricula;
use App\StudentData;
use App\User;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function create(){
        $data = User::where('account','like','%eb48%')->get()->pluck('id');
        foreach ($data as $d){
            $count = StudentCurricula::where('student',$d)->count();
//            echo $count.'<br>';
            if($count == 0){
                echo $d;
            }
        }
//        return $data;
    }



    public function test(){
        $data = User::whereHas('data',function ($query){
            $query->where('course_level',1)
                ->where('stay_in_school',1);
        })->get()->take(50);
        foreach ($data as $d){
            if($d->curriculas->count() == 0){
                echo $d->account." ".$d->id."<br>";
            }
        }
//        return $data;

    }

    public function transaction(){

    }

}
