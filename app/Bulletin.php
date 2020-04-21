<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $guarded = [];

    public function type_name(){
        return $this->belongsTo(BulletinType::class,'type');
    }

    public function get_replies(){
        return $this->hasMany(BulletinReplie::class,'bulletin','id');
    }
}
