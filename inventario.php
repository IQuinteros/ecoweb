
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
require_once __DIR__.('api/query/store.php');
$storeConnection = new Store();

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
      $storeConnection->select_store($id, null, null);
     // $article = $articleConnection->select_article($id);
      //isset($store)
      foreach($article as $value){                                           
           echo "<option value='".$value->title."'>".$value->description.$value->price.$value->stock."</option>";
      }
     ?>
  </table>
  <ul>
<li><a href="NewArticle.php">nuevo articulo</a></li></ul> 
</body>
</html>