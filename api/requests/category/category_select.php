<?php
require_once('../base_request.php');
require_once('../../query/category.php');

$category = new Category();
$result = $category->select_category($data->id, $data->title, $data->creation_date);

if(is_null($result)){
    send_response(false, null, "Categoria no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}
