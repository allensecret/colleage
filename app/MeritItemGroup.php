<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeritItemGroup extends Model
{
    protected $guarded = [];

    public function item(){
        return $this->hasMany(MeritItem::class,'group','id');
    }
}
