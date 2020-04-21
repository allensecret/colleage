<?php

namespace App\Policies;

use App\Admin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataPolicy
{
    use HandlesAuthorization;

    protected $admin = '777';

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(Admin $user){
        return strpos($user->role_name->function,'student_data.review') !== false;
    }

    public function update($user){
        return strpos($user->role_name->function,'student_data.edit') !== false;
    }

    public function delete($user){
        return strpos($user->role_name->function,'student_data.edit') !== false;
    }

    public function before($user){
        if(strpos($user->role_name->function,$this->admin) !== false){
            return true;
        }
        return null;
    }
}
