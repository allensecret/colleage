<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateRecode extends Model
{
    protected $guarded = [];

    public function get_student(){
        return $this->belongsTo(User::class,'student');
    }

//    public function get_level(){
//        return $this->hasOne(CourseLevel::class,'id');
//    }
}
