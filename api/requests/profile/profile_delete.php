<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

$profiles = new Profile();
$result=$profiles->delete_profile($data->id);


send_response($result, null); 