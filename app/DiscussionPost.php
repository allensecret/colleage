<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionPost extends Model
{
    protected $guarded = [];

    public function type_name(){
        return $this->belongsTo(DiscussionBoard::class,'type');
    }

    public function student_name(){
        return $this->belongsTo(User::class,'student');
    }

    public function get_last_student(){
        return $this->belongsTo(User::class,'last_replies');
    }

    public function replies(){
        return $this->hasMany(DiscussionReplies::class,'post');
    }
}
