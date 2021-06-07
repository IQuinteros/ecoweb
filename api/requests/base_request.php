<?php

function send_response(bool $success, mixed $result = null, string $message = null){
    $temp_array = array();

    $temp_array["succces"] = $success;

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