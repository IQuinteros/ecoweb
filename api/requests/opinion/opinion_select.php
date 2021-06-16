<?php
require_once('../base_request.php');
require_once('../../query/opinion.php');

$opinion = new Opinion();

$result=$opinion->select_opinion($data);

if(is_null($result)){
    send_response(false, null, "Historial no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}