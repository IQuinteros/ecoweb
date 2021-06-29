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
require_once __DIR__.('/api/query/profile.php');
$profileConnection = new profile();
require_once  ('include.php');
session_start();
$id = $_SESSION["id"]; 
$chat =$_SESSION["chat"]
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
<?php 
    $object = json_decode(json_encode(array("id"=>null,"closed"=>null,"store_id" => $id)));
     $chat = $chatConnection->select_chat($object);
      foreach($chat as $value){
        $_SESSION["chat"]=$value->id;
        $profile = $profileConnection->select_profile(json_decode(json_encode(array("id" => $value->purchase-> profile_id))));
         if(count($profile) > 0){      ?> <a  href="Chats.php">><?php
            ?><li></li><?php   echo $profile->name.$profile->last_name;    ?> </a><?php        
          }
       }  
              ?>
              
   <div id="contenedor">
         <div id="caja-chat">
              <div id="chat">
              
                   <div id="datos-chat">
                   <span>nombre</span>
                   <span>mensaje</span>
                   <span>hora</span>
                  </div>
             </div>
         </div>
         <form method="POST" action="Chats.php">
         <textarea  name="mensaje" placeholder="mensaje"></textarea>
         <input type="submit" name="enviar" value="enviar">
         </form>
     </div>
     
</body>
</html>