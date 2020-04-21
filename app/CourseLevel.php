<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLevel extends Model
{
    protected $guarded = [];

    public function curricula(){
        return $this->hasMany(Curricula::class,'level');
    }
}
