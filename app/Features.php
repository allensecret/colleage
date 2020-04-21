<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $guarded = [];

    public function item(){
        return $this->hasMany(FeaturesItem::class,'feature','id');
    }
}
