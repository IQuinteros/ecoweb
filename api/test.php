<?php
require_once("controllers/profile.php");

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
            echo "asfdgdsfg";
        }
        else{
            echo "error ";
        }
    ?>
    </body>
</html>