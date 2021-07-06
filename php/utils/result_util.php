<?php

class ResultUtil{

    // This result is for ECOmercio software architecture 
    public static function checkResult($result){

        if(!isset($result)) return false;
        if(gettype($result) != "array") return false;
        if(count($result) <= 0) return false;

        return true;

    }

}