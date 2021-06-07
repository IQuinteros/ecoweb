<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once __DIR__."/controllers/profile_control.php";

$d = new ProfileController();
$res=$d->select_profile();

?>
<html>
    <head>
      
    </head>
    <body>
    <?php 
        if(!is_null($res)){
            echo "Su cuenta ha sido modificada";
            // $res : Resultado (array de profiles models)
            

            echo json_encode($res);
        }
        else{
            echo "error ";
        }
    ?>
    </body>
</html>