<?php
require_once('../base_request.php');
require_once('../../query/photo.php');

$photo = new Photo();

$result=$photo->select_photo($data);

if(is_null($result)){
    send_response(false, null, "Fotos no encontradas"); 
}
else{
    // Return result
    send_response(true, $result);            
}
