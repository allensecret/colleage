<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionBoard extends Model
{
    public function post(){
        $this->hasMany(DiscussionPost::class,'type','id');
    }
}
