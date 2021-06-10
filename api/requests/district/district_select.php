<?php
require_once('../base_request.php');
require_once('../../query/district.php');
$districts = new District();
// Assign result to variable
$result = $districts->select($data);


if(is_null($result)){
    send_response(false, null, "District no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}

