<?php
require_once('../base_request.php');
require_once('../../query/history_detail.php');

$history_d = new History_detail();
$result=$history_d->report_most_visualized($data);

if(is_null($result)){
    send_response(false, null, "Detalle de historial no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}