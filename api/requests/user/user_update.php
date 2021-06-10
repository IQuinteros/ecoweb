<?php
require_once('../base_request.php');
require_once('../../query/user.php');

$users = new User();
$result=$users->update_user_users($data->id);

send_response($result, null);   
