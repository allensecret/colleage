<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $guarded = [];

    public function student_data(){
        return $this->belongsTo(User::class,'student');
    }

}
