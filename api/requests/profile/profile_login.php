<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

if(is_null($data->email) || is_null($data->password)){
    send_response(false, null, 'Falta proporcionar email y/o password');
}

$profiles = new profile();

// Assign result to variable
$result = $profiles->login($data->email, $data->password);

if(is_null($profiles)){
    send_response(false, null, "Profile no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}



