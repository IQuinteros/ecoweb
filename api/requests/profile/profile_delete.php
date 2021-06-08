<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

$profiles = new profile();
$result=$profiles->delete_profile($data->id);


send_response($result, null); 