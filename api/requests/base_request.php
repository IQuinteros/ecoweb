<?php

//ini_set('display_errors', 1);
error_reporting(0);

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

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

if(count($_REQUEST) > 0){
    $data = json_decode(json_encode($_REQUEST), FALSE);
}

if(!isset($data->C8AEA) || $data->C8AEA != 'iyinF635EHL7SF8cmYY6rR9en4uRQjA1'){
    send_response(false, null, 'Not authorized');
}