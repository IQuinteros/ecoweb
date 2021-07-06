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
require_once __DIR__.('/api/query/article_purchase.php');
$article_purchaseConnection = new article_purchase();
require_once __DIR__.('/api/query/article.php');
$articleConnection = new article();
require_once  ('include.php');
session_start();
$id = $_SESSION["id"]; 
$_SESSION["profile"];
$_SESSION["id_chat"];
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
        $profile = $profileConnection->select_profile(json_decode(json_encode(array("id" => $value->purchase-> profile_id))));
        $articleid=$article_purchaseConnection->select_article_purchase(json_decode(json_encode(array("store_id" => $id,"purchase_id"=>$value->purchase->id))));
        $article=$articleConnection->select_article((json_decode(json_encode(array("id" => $articleid[0]->article_id)))));
        echo $articleid[0]->title;
         if(count($profile) > 0){      ?>  
         
            <?php
            ?><li></li>
            <?php   echo $profile[0]->name;
            $profile[0]->last_name;   
          }   ?> 
        
          <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> method="POST">    
          <input type="hidden" name="id_profile" value=<?php $profile[0]->id ?> />
          <input type="hidden" name="id_chat" value=<?php $value->id ?> />     
              <input type="submit" name="chat" value="chat">
          </form>>
          <?php 
           if(isset($_POST['chat'])){ 
         $_SESSION["profile"]=$_POST['id_profile'];
         $_SESSION["id_chat"]=$_POST['id_chat'];
        
        }
       }
              ?>
              
   <div id="contenedor">
         <div id="caja-chat">
              <div>
              
                   <div id="datos-chat">
                   <span><?php
                      $profileConnection->select_profile(json_decode(json_encode(array("id" =>$_SESSION["profile"]))));
                   echo $profile[0]->name;
            $profile[0]->last_name." : ";    ?> 
            </span>
                   <span><?php 
                   $message=$messageConnection->select_message(json_decode(json_encode(array("chat_id" => $_SESSION["id_chat"]))));
                   foreach($message as $val){
                       echo $val->message." ";
                       echo $val->creation_date;?><li></li>
                    <?php
                   }
                   ?></span>
                  </div>
             </div>
         </div>
         <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> method="POST" action="Chats.php">
         <textarea  name="messa" placeholder="mensaje" id="messa"></textarea>
         <input type="submit" name="enviar" value="enviar">
         </form>
         <?php 
       if(isset($_POST['enviar'])){ 
        $messa=$_POST['messa'];
         

        $messageConnection->insert_message(json_decode(json_encode(array("message"=>$messa,"chat_id"=>$_SESSION["id_chat"]))));
        
        }?>
     </div>
     
</body>
</html>