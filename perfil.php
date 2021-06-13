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

require_once('api/query/profile.php');
$profileConnection = new profile();
require_once('api/query/user.php');
$userConnection = new user();
require_once('include.php');
require_once('api/query/district.php');
$districtConnection = new district();

 ?>
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
<form action="api/requests/example.php" method="POST">
        <label for="name">  nombre:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="last_name">apellido:</label>
        <input type="text" id="last_name" name="last_name"><br><br>
        <label for="email">email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="contact_number">telefono:</label>
        <input type="text" id="contact_number" name="contact_number"><br><br>
        <label for="birthday">cumpleaños:</label>
        <input type="text" id="birthday" name="birthday"><br><br>
        <label for="location">direccion:</label>
        <input type="text" id="location" name="location"><br><br>
        <label for="passwords">passwords:</label>
        <input type="text" id="passwords" name="passwords"><br><br>
        <label for="rut">rut:</label>
        <input type="text" id="rut" name="rut">
        <label for="rut_cd">rut cd:</label>
        <input type="text" id="rut_cd" name="rut_cd"><br><br>
        <select>
           <option>
               <?php 
                $distritos = $districtConnection->select(null);
                foreach($distritos as $value){                                                 
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }

                
               ?>           
           </option>
       </select>
        <input type="submit" value="nuevo peril"/>
      </form>
</body>
</html>