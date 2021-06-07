<?php
require_once('../../query/profile.php');
$profiles = new profile();
// Assign result to variable
$result = $profiles->select_profile();?>
<html>
    <head></head>
    <body>
        <?php
        if(is_null($profiles)){
            echo json_encode("Error (Profile no encontrado)");
        }
        else{
            // Return result
            echo json_encode($result);
        }
        ?>
    </body>
</html>

