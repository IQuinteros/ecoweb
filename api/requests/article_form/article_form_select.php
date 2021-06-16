<?php
require_once('../base_request.php');
require_once('../../query/article_form.php');

$article_f = new Article_form();
$result=$article_f->select_article_form($data);

if(is_null($result)){
    send_response(false, null, "Formulario no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}