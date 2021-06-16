<?php
require_once('../base_request.php');
require_once('../../query/answer.php');

$answer = new Answer();

$result=$answer->select_answer($data);

if(is_null($result)){
    send_response(false, null, "Respuestas no encontradas"); 
}
else{
    // Return result
    send_response(true, $result);            
}