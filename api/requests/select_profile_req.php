<?php
require_once("../controllers/profile.php");

// Get id from post
$id = $_POST["id"];

// Use profile controller
$profile_controller = new ProfileController();
$profile = $profile_controller->select_profile($id);

if(is_null($profile)){
    echo json_encode("Error (Profile no encontrado)");
}
else{
    echo json_encode($profile->toArray());
}

