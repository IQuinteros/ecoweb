<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

$profiles = new Profile();
$result=$profiles->update_profile($data->name, $data->last_name, $data->email, $data->contact_number, $data->birthday, $data->location, $data->district_id, $data->id);

send_response($result, null); 