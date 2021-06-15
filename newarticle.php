<?php 
 if(isset($_POST['submit'])){

    $recycled_mats=$_POST['recycled_mats'];
    $recycled_mats_detail=$_POST['recycled_mats_detail'];
    $reuse_tips=$_POST['reuse_tips'];
    $recycled_prod=$_POST['recycled_prod'];
    $recycled_prod_detail=$_POST['recycled_prod_detail'];
    $article_form->recycled_mats=$recycled_mats;
    $article_form->recycled_mats_detail=$recycled_mats_detail;
    $article_form->reuse_tips=$reuse_tips;
    $article_form->recycled_prod=$recycled_prod;
    $article_form->recycled_prod_detail=$recycled_prod_detail;
    
    //$insert_article_form=$article_formConnection->insert_article_form($article_form);
    //return array($re, $user_id);
    //$insert_article[1]


     $title =$_POST['title'];
     $description=$_POST['description'];
      $price=$_POST['price'];
     $stock=$_POST['stock'];
     $category_id=$_POST['category_id'];
     $article->title=$title;
     $article->description=$description;
     $article->price=$price;
     $article->stock=$stock;
     $article->category_id=$category_id;
     $article->store_id=$idStore;
     $article->article_form_id=$insert_article[1];    
     $insert_article=$articleConnection->insert_article($article);

     
     
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nuevo producto</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once('include.php');
require_once __DIR__.('api/query/article.php');
$articleConnection = new article();
require_once __DIR__.('api/query/article_form.php');
//$article_formConnection = new article_form();
require_once __DIR__.('api/query/category.php');
$categoryConnection = new category();
$idStore = $_SESSION["id"]; 
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
        <label for="title"> nombre del producto:</label>
        <input type="text" id="title" name="title"><br><br>
        <label for="description">description:</label>
        <input type="text" id="description" name="description"><br><br>
        <label for="price">precio:</label>
        <input type="text" id="price" name="price"><br><br>
        <label for="stock">stock:</label>
        <input type="text" id="stock" name="stock"><br><br>         
       <select id="category_id" name="category_id"><br><br>
           <option>
               <?php 
                $category = $categoryConnection->select_category(null,null,null);
                foreach($category as $value){                                           
                    echo "<option value='".$value->id."'>".$value->title."</option>";
                }
               ?>           
           </option>
       </select>
       <form action="#" method="post" onsubmit="validar()">
<input type="checkbox" name="recycled_mats" value="TOTAL">TOTAL</input>
<input type="checkbox" name="recycled_mats" value="PARCIAL">PARCIAL</input>
<input type="checkbox" name="recycled_mats" value="NINGUNO">NINGUNO</input>
</form>
<label for="recycled_mats_detail">da detalles al cliente:</label>
        <input type="text" id="recycled_mats_detail" name="recycled_mats_detail"><br><br>
        <label for="reuse_tips">¿en que se puede reutilizar el producto?:</label>
        <input type="text" id="reuse_tips" name="reuse_tips"><br><br>
        <input type="checkbox" name="recycled_prod" value="TOTAL">TOTAL</input>
<input type="checkbox" name="recycled_prod" value="PARCIAL">PARCIAL</input>
<input type="checkbox" name="recycled_prod" value="NINGUNO">NINGUNO</input><br><br>
</form><br><br>
<label for="recycled_prod_detail">¿puede dar mas detalle?:</label>
        <input type="text" id="recycled_prod_detail" name="recycled_prod_detail"><br><br>
        <button onclick="sendData(insert_article,insert_article_form)" value="nuevo producto" name="submit"
        <?php                 
   //         if(isset($store)){
      //
       // }
        ?>
       >nuevo producto</button>
</body>
</html>