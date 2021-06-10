<?php

ini_set('display_errors', 1);
error_reporting(~0);

header('Content-Type: application/json');

function send_response(bool $success, $result = null, string $message = null){
    $temp_array = array();

    $temp_array["success"] = $success;

    if(!is_null($message)){
        $temp_array["message"] = $message;
    }

    if(!is_null($result)){
        $temp_array["data"] = $result;
    }

    echo json_encode($temp_array);
    exit();
    return;
}

function array_to_object($array) {
    $obj = new stdClass;
    foreach($array as $k => $v) {
        if(strlen($k)) {
            if(is_array($v)) {
                $obj->{$k} = array_to_object($v); //RECURSION
            } else {
                $obj->{$k} = $v;
            }
        }
    }
    return $obj;
} 

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

echo($data);

if(count($_POST) > 0){
    $data = array_to_object($_POST);
}

echo($data);