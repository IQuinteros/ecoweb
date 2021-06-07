<?php
require_once('../base_request.php');
require_once('../../query/profile.php');
$id=$_POST["id"];
$password=$_POST["pass"];
$profiles = new profile();
$result=$profiles->update_profile_pass($password, $id);

send_response($result, null); 