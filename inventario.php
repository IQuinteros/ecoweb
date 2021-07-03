
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
require_once __DIR__.('/api/query/article.php');
$articleConnection = new article();
require_once __DIR__.('/api/query/article_form.php');
$article_fromConnection = new article_form();
require_once __DIR__.('/api/query/store.php');
$storeConnection = new Store();
require_once __DIR__.('/api/query/history.php');
$historyConnection = new history();
require_once __DIR__.('/api/query/opinion.php');
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
     session_start();
    $id = $_SESSION["id"];   
    echo "Store id: ".$id;   

     $object = json_decode(json_encode(array("id_store" => $id)));
     
      $article = $articleConnection->select_article($object); 
      foreach($article as $value){                                           
           echo "".$value->title?> <li></li><?php echo " ".$value->description?><li></li><?php echo " precio :".$value->price ?><li></li><?php echo "disponible :".$value->stock."";
           ?><li></li>
           <?php echo "material : ".$value->form->recycled_mats ?><li></li><?php "producion : ".$value->form->recycled_prod."";
          $history=$historyConnection->select_history($value->id);
          $cont=0;
          foreach($history as $val){
            $cont =$cont+1;
          }          
          echo "
          visualisaciones :".$cont;
      $con=0;
      $add=0;
      $opinion=$opinionConection->select_opinion(null,$value->id);
      foreach($opinion as $va){
        $add=$va->rating+$add;
        $con =$con+1;
      }
      $star=$add/$con; ?><li></li><?php
      echo " estrellas :".$star;?><li></li><?php
    }
     ?>
  </table>
  <ul>
<li><a href="nuevoarticulo.php">nuevo articulo</a></li></ul> 
</body>
</html>