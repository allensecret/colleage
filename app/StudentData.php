<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentData extends Model
{
    protected $hidden = ['id'];

    protected $guarded = [];

    public function student_id(){
        return $this->belongsTo(User::class,'student');
    }

    public function level(){
        return $this->belongsTo(CourseLevel::class,'course_level');
    }
}
