<?php
require_once('../../query/profile.php');
$name=$_POST["name"];
$last_name=$_POST["last_name"];
$email=$_POST["email"];
$contact_number=$_POST["contact_number"];
$birthday=$_POST["birthday"];
$terms_checked=$_POST["terms"];
$location=$_POST["location"];
$rut=$_POST["rut"];
$rut_cd=$_POST["rut_cd"];
$creation_date=$_POST["creation_date"];
$last_update_date=$_POST["last_update"];
$district_id=$_POST["district"];
$user_id=$_POST["user"];
$profiles = new profile();
$profiles->insert_profile();