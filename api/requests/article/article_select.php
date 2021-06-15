<?php
require_once('../base_request.php');
require_once('../../query/article.php');

$article = new Article();
echo json_encode($data);
$result=$article->select_article($data);

if(is_null($result)){
    send_response(false, null, "District no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}

