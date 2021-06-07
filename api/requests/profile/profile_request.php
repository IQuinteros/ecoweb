<?php
require_once('../../query/profile.php');
$profiles = new profile();
$profiles->select_profile();?>
<html>
    <head></head>
    <body>
        <?php
        if(is_null($profiles)){
            echo json_encode("Error (Profile no encontrado)");
        }
        else{
            echo json_encode($profiles);
            echo "hola";
        }
        ?>
    </body>
</html>

