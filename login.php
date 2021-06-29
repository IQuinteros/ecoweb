<?php 
 if(isset($_POST['submit'])){        
     $email =$_POST['email'];
     $passwords=$_POST['passwords'];
     require_once __DIR__.('/api/query/store.php');
     $storeConnection = new Store();
     $login_store = $storeConnection->login($email, $passwords);
        $_SESSION["id"] = $login_store->id;
        print ( $_SESSION["id"]);
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
session_start();
ini_set('display_errors', 1);
error_reporting(~0);
require_once('include.php');
 ?>
 <script>
 x =<?php  $_SESSION["id"]?>;
 if(  x != null){
 var page="home.php";
 }else{if(x == null
 ){
    var page="login.php"
 }} 
 </script>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="login_store">
        <label for="email">Correo</label>
        <input type="text" id="email" name="email" placeholder="ingrese email"><br><br>
        <label for="passwords">contraseña </label>
        <input type="text" id="passwords" name="passwords" placeholder="ingrese contraseña"><br><br>
        <a href="<script type='text/javascript'> document.write(page); </script>" value="ir"> <button onclick="sendData(login_store)" value="login" name="submit"
        <?php             
        ?>
       >login</button></a>
      </form>
</body>
</html>
