<?php
namespace App\Classes;

class txtRead {

    public function txt($attr){

        $file_handle = fopen($attr, "r");
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            echo $line."<br>";
        }
        fclose($file_handle);
    }
}
