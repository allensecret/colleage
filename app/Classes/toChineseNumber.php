<?php
namespace App\Classes;

class toChineseNumber{
    function num2zh($num){
        $zh = array('', '一', '二', '三', '四', '五', '六', '七', '八', '九','十');
        return $zh[$num];
    }

}
