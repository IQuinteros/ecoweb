<?php
require_once('../base_request.php');
require_once('../../query/article_purchase.php');

$a_purchase = new Article_purchase();

$result=$a_purchase->report_most_selled($data);

if(is_null($result)){
    send_response(false, null, "Articulos de la compra no encontrados"); 
}
else{
    // Return result
    send_response(true, $result);            
}
