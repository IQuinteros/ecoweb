<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

$profiles = new profile();
$result=$profiles->insert_profile($data->name, $data->last_name, $data->email, $data->contact_number, $data->birthday, 
$data->terms_checked, $data->location, $data->passwords, $data->rut, $data->rut_cd, $data->district, $data->user);

send_response($result, null);   
