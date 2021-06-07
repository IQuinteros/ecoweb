<?php
require_once('../base_request.php');
require_once('../../query/profile.php');
$name=$_POST["name"];
$last_name=$_POST["last_name"];
$email=$_POST["email"];
$contact_number=$_POST["contact_number"];
$birthday=$_POST["birthday"];
$terms_checked=$_POST["terms"];
$location=$_POST["location"];
$passwords=$_POST["pass"];
$rut=$_POST["rut"];
$rut_cd=$_POST["rut_cd"];
$district_id=$_POST["district"];
$user_id=$_POST["user"];
$profiles = new profile();
$result=$profiles->insert_profile($name, $last_name, $email, $contact_number, $birthday, 
$terms_checked, $location, $passwords, $rut, $rut_cd, $district_id, $user_id);

send_response($result, null);   
