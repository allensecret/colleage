<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function student_id(){
        return $this->belongsTo(User::class,'student');
    }

    public function course(){
        return $this->belongsTo(Curricula::class,'curricula');
    }
}
