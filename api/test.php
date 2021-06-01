<?php
require_once('query/district.php');

$d= new district();
$name=$_POST['name'];
$res=$d->insert_district($name);
?>
<html>
    <head>
      
    </head>
    <body>
    <?php if($res){echo "Su cuenta ha sido modificada";}?>,
    </body>
</html>