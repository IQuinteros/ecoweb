<?php
require_once('../base_request.php');
require_once('../../query/profile.php');
$profiles = new profile();
// Assign result to variable
$result = $profiles->select_profile();?>
<html>
    <head></head>
    <body>
        <?php
        if(is_null($profiles)){
            send_response(false, null, "Profile no encontrado"); 
        }
        else{
            // Return result
            send_response(true, $result);            
        }
        ?>
    </body>
</html>

