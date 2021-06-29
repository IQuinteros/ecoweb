<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once __DIR__.('/php/utils/auth_util.php');

AuthUtil::login("huevos@gmail.com", "123456");
AuthUtil::logout();

if(AuthUtil::getStoreSession() != null){
    // Sesión iniciada
    echo AuthUtil::getStoreSession()->public_name;
} else{
    // Sesión no iniciada
    echo 'No está iniciada la sesión';
}

?>

</body>
</html>