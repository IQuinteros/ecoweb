<?php
require_once('../base_request.php');
require_once('../../query/favorite.php');

$favorite = new Favorite();

$result=$favorite->report_favorite($data);

if(is_null($result)){
    send_response(false, null, "Favoritos no encontrados"); 
}
else{
    // Return result
    send_response(true, $result);            
}