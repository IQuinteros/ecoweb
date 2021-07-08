<?php
require_once('../base_request.php');
require_once('../../query/history.php');

$history = new History();
$result=$history->report_most_visited($data);

if(is_null($result)){
    send_response(false, null, "Historial no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}