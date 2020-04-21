<?php
namespace App\Classes;

use Illuminate\Support\Facades\Log;

class validate_email {
    public $email;
    public function __construct($email)
    {
        $this->email = $email;
    }

    protected function filter(){
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            return false;
        }
        return true;
    }

    protected function checkdns(){
        $tmp = explode("@",$this->email);
        if(checkdnsrr(array_pop($tmp),"MX") === false) {
            return false;
        }
        return true;
    }

    public function validate(){
        if($this->filter() === false || $this->checkdns() === false){
            Log::info($this->email.'信箱錯誤');
            return false;
        }

        return true;
    }
}
