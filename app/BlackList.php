<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    protected $guarded = [];

    public function get_student(){
        return $this->hasOne(User::class,'id','student');
    }
}
