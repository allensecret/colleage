<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merit extends Model
{
    protected $guarded = [];

    public function item_data(){
        return $this->hasMany(MeritItem::class,'merit');
    }

    public function item_group(){
        return $this->hasMany(MeritItemGroup::class,'merit');
    }
}
