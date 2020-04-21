<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

class CourseData extends Model
{
    protected $guarded = [];

    public function get_media(){
        return $this->hasMany(CurriculaMedia::class,'course_data','id');
    }

    public function resources(){
        return $this->hasMany(CurriculaResource::class,'course_data');
    }

    public function delete(){
        $this->get_media()->delete();
        $this->resources()->delete();
        return parent::delete();
    }
}
