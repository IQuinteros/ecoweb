<?php
require_once('../base_request.php');
require_once('../../query/search.php');

$search = new Search();
$result=$search->select_search($data);

if(is_null($result)){
    send_response(false, null, "search no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}