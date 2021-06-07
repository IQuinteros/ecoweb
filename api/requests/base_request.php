<?php

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