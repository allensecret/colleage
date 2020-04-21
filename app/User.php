<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'account', 'password','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function data(){
        return $this->hasOne(StudentData::class,'student');
    }

    public function curriculas(){
        return $this->hasMany(StudentCurricula::class,'student','id');
    }

    public function drop_status(){
        return $this->hasMany(Drop::class,'student');
    }

    public function black(){
        return $this->hasOne(BlackList::class,'student');
    }

    public function update_recode(){
        return $this->hasMany(UpdateRecode::class,'student');
    }
}
