<?php
require_once('../base_request.php');
require_once('../../query/user.php');

$users = new User();
$result=$users->select_user($data);

send_response($result, null);   
