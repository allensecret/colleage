<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function course_level()
    {
        return $this->hasMany(CourseLevel::class,'course');
    }
}
