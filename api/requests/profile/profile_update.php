<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$profiles = new profile();
$result=$profiles->update_profile($data->name, $data->last_name, $data->email, $data->contact_number, $data->birthday, $data->location, $data->district, $data->id);

send_response($result, null); 