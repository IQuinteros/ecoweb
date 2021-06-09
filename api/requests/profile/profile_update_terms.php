<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

$profiles = new profile();
$result=$profiles->update_profile_terms($data->terms_checked, $data->id);

send_response($result, null); 