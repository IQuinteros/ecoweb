<?php
require_once('../base_request.php');
require_once('../../query/profile.php');
$profiles = new Profile();
// Assign result to variable
$result = $profiles->report_user_resgistered($data);

if(is_null($result)){
    send_response(false, null, "Profile no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}