<?php
require_once('query/profile.php');

$d= new profile();
$name=$_POST['name'];
$last_name=$_POST{'2'};
$email=$_POST{'3'};
$contact_number=$_POST{'4'};
$birthday=$_POST{'5'};
$terms_checked=$_POST{'6'};
$location=$_POST{'7'};
$passwords=$_POST{'8'};
$rut=$_POST{'9'};
$rut_cd=$_POST{'10'};
$district_id=$_POST{'11'};
$res=$d->insert_profile($name, $last_name, $email, $contact_number, $birthday, $terms_checked, $location, $passwords, $rut, $rut_cd, $district_id);
?>
<html>
    <head>
      
    </head>
    <body>
    <?php if($res){echo "Su cuenta ha sido modificada";
    }else{echo "error ";}?>,
    </body>
</html>