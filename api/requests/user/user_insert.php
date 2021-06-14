<?php
require_once('../base_request.php');
require_once('../../query/user.php');

ini_set('display_errors', 1);
error_reporting(~0);

$users = new User();
$result=$users->insert_user(null);

send_response(isset($result), $result);    
