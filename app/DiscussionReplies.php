<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionReplies extends Model
{
    protected $guarded = [];

    public function get_student_name(){
        return $this->belongsTo(User::class,'student','id');
    }

    public function get_post(){
        return $this->belongsTo(DiscussionPost::class,'post');
    }
}
