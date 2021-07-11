<?php
require_once('../base_request.php');
require_once('../../query/chat.php');

$chat = new Chat();

$result = $chat->select_chat($data);
$tempResult = json_decode(json_encode($result));
foreach($tempResult as $chat){
    $chat->messages = array_map(function($val){
        $val->from_store = $val->from_store? 1 : 0;
        return $val;
    }, $chat->messages);
}


if(is_null($result)){
    send_response(false, null, "Chat no encontrado"); 
}
else{
    // Return result
    send_response(true, $tempResult);            
}
