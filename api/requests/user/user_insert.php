<?php
require_once('../base_request.php');
require_once('../../query/user.php');

$users = new User();
$result=$users->insert_user();

send_response($result, null);   
