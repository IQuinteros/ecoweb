<?php
require_once('../base_request.php');
require_once('../../query/store.php');

$store = new Store();

$result=$store->select_store($data);

if(is_null($result)){
    send_response(false, null, "Store no encontrada"); 
}
else{
    // Return result
    send_response(true, $result);            
}