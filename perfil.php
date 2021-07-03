<?php 
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
$_SESSION["id"];
require_once __DIR__.('/api/query/district.php');
$districtConnection = new district();
 if(isset($_POST['submit'])){
    require_once __DIR__.('/api/query/profile.php');
    $profileConnection = new profile();    
    require_once('include.php');
     $email =$_POST['email'];
     $contact_number=$_POST['contact_number'];
      $location=$_POST['location'];
     $district=$_POST['district'];
     $id=$_SESSION["id"];
     $selec_profile=$profileConnection->select_profile(json_decode(json_encode(array("email"=>$email))));
     $id_profile=$selec_profile[0]->id;     
     $update_profile=$profileConnection->update_profile(null, null, $email, $contact_number, null, $location, $district_id, $id); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<ul>
<li><a href="home.php">home</a></li>
<li><a href="pedidos.php">pedidos</a><li>
<li><a href="Chats.php">Chats</a><li>
<li><a href="preguntas.php">preguntas</a><li>
<li><a href="valoraciones.php">valoraciones</a><li>
<li><a href="inventario.php">inventario</a><li>
<li><a href="reportes.php">reportes</a><li>
<li><a href="perfil.php">perfil</a><li>
</ul>
 <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> method="POST" >
       
       
       
        <label for="email">email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="contact_number">telefono:</label>
        <input type="text" id="contact_number" name="contact_number"><br><br>
        <label for="location">direccion:</label>
        <input type="text" id="location" name="location"><br><br>
        <select id="district" name="district">
           <option>
               <?php 
                $distritos = $districtConnection->select(null);
                foreach($distritos as $value){                                                 
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }
               ?>           
           </option>
       </select>
       <button onclick="sendData(update_profile)" value="guardar cambios" name="submit"
        <?php         
        
            if(isset($store)){
      
       }
        ?>
       >guardar cambios</button>
      </form>
</body>
</html>