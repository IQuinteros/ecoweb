<?php 
 if(isset($_POST['submit'])){     
     $email =$_POST['email'];
     $passwords=$_POST['passwords'];
     require_once __DIR__.('/api/query/store.php');
     $storeConnection = new Store();
     //$login_store = $storeConnection->login($correo, $passwords);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once('include.php');

session_start();
// Hiciste el login 
$store;

$_SESSION["id"] = $store->id;

 ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="login_store">
        <label for="email">Correo</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="passwords">contraseña </label>
        <input type="text" id="passwords" name="passwords"><br><br>
        <button onclick="sendData(login_store)" value="login" name="submit"
        <?php         
        
   //         if(isset($store)){
      //      window.open('home.php')
       // }
        ?>
       >login</button>
      </form>
</body>
</html>
