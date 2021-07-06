<?php
require_once('../base_request.php');
require_once('../../query/info_purchase.php');

$info = new Info_purchase();

$result=$info->select_info_purchase($data);

if(is_null($result)){
    send_response(false, null, "Informacion de compra no encontrada"); 
}
else{
    // Return result
    send_response(true, $result);            
}