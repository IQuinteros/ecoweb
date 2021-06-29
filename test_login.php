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

echo AuthUtil::login("huevos@gmail.com", "123456")? "Logged": "Doesn't work";
echo AuthUtil::getStoreSession() != null? AuthUtil::getStoreSession()->public_name : "Not login";

AuthUtil::login("huevos@gmail.com", "123456");
AuthUtil::getStoreSession();
AuthUtil::logout();

?>

</body>
</html>