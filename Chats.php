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
require_once __DIR__.('/api/query/store.php');
$storeConnection = new Store();
require_once __DIR__.('/api/query/message.php');
$messageConnection = new message();
require_once __DIR__.('/api/query/chat.php');
$chatConnection = new chat();
require_once __DIR__.('/api/query/user.php');
$userConnection = new user();
require_once __DIR__.('/api/query/profile.php');
$profileConnection = new profile();
?>
<?php 
session_start();
$id = $_SESSION["id"]; 
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
<input type="image" name="botondeenvio" src="" alt="Enviar formulario" value="">
<table>

     <?php 
     
    //  $article = $articleConnection->select_message(null);
      //isset($store)
     // foreach($message as $value){                                            
      //     echo "<option value='".$value->title."'>".$value->description.$value->price.$value->stock."</option>";
    // }
     ?>
  </table>
</body>
</html>