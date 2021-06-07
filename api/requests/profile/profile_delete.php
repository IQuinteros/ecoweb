<?php
require_once('../../query/profile.php');
$id=$_POST["id"];
$profiles = new profile();
$result=$profiles->delete_profile($id);
if($result){
    echo json_encode(array("success"=>$result));
}else{
    echo "ha ocurrido un error con la operacion";
}