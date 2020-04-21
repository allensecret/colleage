<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BulletinType extends Model
{
    protected $guarded = [];

    public function bulletin(){
        return $this->hasMany(Bulletin::class,'type');
    }
}
