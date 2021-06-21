<?php
require_once('../base_request.php');
require_once('../../query/purchase.php');

$purchase = new Purchase();

$result=$purchase->select_purchase($data);

if(is_null($result)){
    send_response(false, null, "Compra no encontrada"); 
}
else{
    // Return result
    send_response(true, $result);            
}
