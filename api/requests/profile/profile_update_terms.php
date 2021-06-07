<?php
require_once('../base_request.php');
require_once('../../query/profile.php');
$id=$_POST["id"];
$terms_checked=$_POST["terms"];
$profiles = new profile();
$result=$profiles->update_profile_terms($terms_checked, $id);

send_response($result, null); 