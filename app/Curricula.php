<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curricula extends Model
{
    protected $guarded = [];

    public function coursedata(){
        return $this->belongsTo(CourseData::class,'course_data');
    }

    public function student_curricula(){
        return $this->hasMany(StudentCurricula::class,'curricula');
    }

}
