<?php
require_once('query/search.php');

$d= new search();
$search_text=$_POST['name'];
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
$id=$_POST{'12'};
$user_id=$_POST{'13'};
$res=$d->insert_search_registered($search_text, $user_id);
?>
<html>
    <head>
      
    </head>
    <body>
    <?php if($res){echo "Su cuenta ha sido modificada";
    }else{echo "error ";}?>,
    </body>
</html>