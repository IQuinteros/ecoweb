<?php
require_once('../base_request.php');
require_once('../../query/chat.php');

$chat = new Chat();

$result=$chat->select_chat($data);

if(is_null($result)){
    send_response(false, null, "Chat no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}
