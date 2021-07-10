<?php
require_once __DIR__.('/php/utils/auth_util.php');

$email     =    $_POST['email'];
$password  =    $_POST['password'];

$result = AuthUtil::login($email, $password);

if($result){
    header('Location:dashboard.php');
}
else{
    header('Location:login.php?error=true');
}