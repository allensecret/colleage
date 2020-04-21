<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculaMedia extends Model
{
    protected $guarded = [];

    public function data(){
        return $this->belongsTo(CourseData::class,'course_data');
    }

    public function resource(){
        return $this->hasMany(CurriculaResource::class,'media');
    }
}
