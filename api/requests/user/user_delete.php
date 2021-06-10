<?php
require_once('../base_request.php');
require_once('../../query/user.php');

$users = new User();
$result=$users->delete_user($data->id);

send_response($result, null);   
