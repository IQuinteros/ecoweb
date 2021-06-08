<?php
require_once('../base_request.php');
require_once('../../query/profile.php');

// Get post values
$email = $_POST["email"];
$password = $_POST["password"];

if(is_null($email) || is_null($password)){
    send_response(false, null, 'Falta proporcionar email y/o password');
}

$profiles = new profile();

// Assign result to variable
$result = $profiles->login($email, $password);

if(is_null($profiles)){
    send_response(false, null, "Profile no encontrado"); 
}
else{
    // Return result
    send_response(true, $result);            
}



