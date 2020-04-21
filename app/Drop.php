<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    protected $guarded = [];

    public function student_data(){
        return $this->belongsTo(User::class,'student');
    }
}
