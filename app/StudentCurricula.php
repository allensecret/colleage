<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCurricula extends Model
{
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Curricula::class,'curricula');
    }

    public function get_student(){
        return $this->belongsTo(User::class,'student');
    }
}
