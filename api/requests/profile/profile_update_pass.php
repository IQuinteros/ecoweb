<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

if(!isset($data)) { send_response(false, null); }
$profiles = new Profile();

if(!isset($data->id) || !isset($data->password)) { send_response(false, null); }
$result=$profiles->update_profile_pass($data->password, $data->id);
send_response($result, null); 