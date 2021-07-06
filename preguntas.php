<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once __DIR__.('/api/query/article.php');
$articleConnection = new article();
require_once __DIR__.('/api/query/question.php');
$questionConnection = new question();
require_once __DIR__.('/api/query/store.php');
$storeConnection = new Store();
require_once __DIR__.('/api/query/user.php');
$userConnection = new user();
require_once __DIR__.('/api/query/profile.php');
$profileConnection = new profile();

require_once  ('include.php');

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
     session_start();
    $id = $_SESSION["id"];
     $object = json_decode(json_encode(array("store_id" => $id)));
     
      $article = $articleConnection->select_article($object); 
      foreach($article as $value){
        echo $value->title; ?><li></li><?php
           $question =$questionConnection->select_question(null,$value->id);
           foreach($question as $val){
            $profile = $profileConnection->select_profile(json_decode(json_encode(array("id" => $val->profile_id))));
            
            if(count($profile) > 0){
              ?><li></li><?php   echo $profile[0]->name.$profile[0]->last_name;
            }
            echo "".$val->question;
            $id_question =$val->id;

      }
      ?> 
      <form action="respuesta.php" method="post">
     <input type="hidden" name="id_question" value="<?php $id_question?>" />            
                  <input type="submit" value="Responder" />
            </form>
      <?php
    }
          
          ?>


</body>
</html>