<?php
require_once('../base_request.php');
require_once('../../query/profile.php');
$id=$_POST["id"];
$profiles = new profile();
$result=$profiles->delete_profile($id);


send_response($result, null); 