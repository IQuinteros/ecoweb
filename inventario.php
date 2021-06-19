
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inventario</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once __DIR__.('api/query/article.php');
$articleConnection = new article();
require_once __DIR__.('api/query/article_from.php');
$article_fromConnection = new article_form();
require_once __DIR__.('api/query/store.php');
$storeConnection = new Store();
require_once __DIR__.('api/query/history.php');
$historyConnection = new history();
require_once __DIR__.('api/query/opinion.php');
$opinionConection = new opinion();

require_once('include.php');

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
  <table>
     <?php      
      $id = $_SESSION["id"];      
     //$storeConnection->select_store($id, null, null);
     $object->id=null;
     $object->id_form=null;
     $object->id_category=null;
     $object->id_store=$id;
     $opi->id=null;
     
      $article = $articleConnection->select_article($object); 
      //isset($store)
      foreach($article as $value){                                           
           echo "<option value='".$value->title."'>".$value->description.$value->price.$value->stock."</option>";
          $article_form =$article_fromConnection->select_article_form($value->article_form_id);
          return array($re, $user_recycled_mats,$user_recycled_prod);
          echo "".$user_recycled_mats."".$user_recycled_prod."";
          $history=$historyConnection->select_history($value->id);
          $cont=0;
          foreach($history as $value){
            $cont =$cont+1;
          }
          echo "visualisaciones :".$cont;
          $opi->article_id=$value->id;
         $opinion=$opinionConection->select_opinion($opi);
      }
      $con=0;
      foreach($opinion as $value){
        $add=$value->rating+$add;
        $con =$con+1;
      }
      $star=$add/$con;
      echo "".$star;
     ?>
  </table>
  <ul>
<li><a href="newarticle.php">nuevo articulo</a></li></ul> 
</body>
</html>