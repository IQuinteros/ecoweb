<?php
require_once('../../query/profile.php');
$id=$_POST["id"];
$name=$_POST["name"];
$last_name=$_POST["last_name"];
$email=$_POST["email"];
$contact_number=$_POST["contact_number"];
$birthday=$_POST["birthday"];
$location=$_POST["location"];
$district_id=$_POST["district"];
$profiles = new profile();
$result=$profiles->update_profile($name, $last_name, $email, $contact_number, $birthday, $location, $district_id, $id);
if($result){
    echo json_encode(array("success"=>$result));
}else{
    echo "ha ocurrido un error con la operacion";
}