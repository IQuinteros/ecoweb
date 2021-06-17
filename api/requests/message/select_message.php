<?php
require_once('../base_request.php');
require_once('../../query/message.php');

$message = new Message();

$result=$message->select_message($data);

if(is_null($result)){
    send_response(false, null, "Mensaje no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}
