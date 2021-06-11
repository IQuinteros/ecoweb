<?php 
 if(isset($_POST['submit'])){
     $nombre =$_POST['PNoC'];
     $correo =$_POST['PNoC'];
     $passwords=$_POST['passwords'];


     require_once __DIR__.('/api/query/store.php');
     $storeConnection = new Store();
     //$logged = $storeConnection->login($correo, $passwords);
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

 ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="login_store">
        <label for="Pname"> Nombre o Correo</label>
        <input type="text" id="PNoC" name="PNoC"><br><br>
        <label for="passwords">contraseña </label>
        <input type="text" id="passwords" name="passwords"><br><br>
        <button onclick="sendData(login_store)" value="login" name="submit"
        <?php         
        
      //  $store = $storeConnection->search($nombre,$passwords);    
   //         if(isset($store)){
      //      window.open('home.php')
       // }
        //?>
       >login</button>
      </form>
</body>
</html>
