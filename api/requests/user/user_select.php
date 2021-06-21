<?php
require_once('../base_request.php');
require_once('../../query/user.php');

$users = new User();
$result=$users->select_user($data);

if(isset($result)){
    send_response(true, $result);  
} 
else{
    send_response(false, null);
}
