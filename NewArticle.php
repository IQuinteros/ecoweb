<?php 
 if(isset($_POST['submit'])){
     $title =$_POST['title'];
     $description=$_POST['description'];
      $price=$_POST['price'];
     $stock=$_POST['stock'];
     $category_id=$_POST['category_id'];     
     $article->id=null;
     $article->title=$title;
     $article->description=$description;
     $article->price=$price;
     $article->stock=$stock;
     $article->category_id=$category_id;
     $article->store_id=$idStore;
     $article->article_form_id=$article_form_id;
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
//require_once __DIR__.('api/query/article_form.php');
//$articleConnection = new article_form();
require_once __DIR__.('api/query/category.php');
$articleConnection = new category();
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
       <select id="category_id" name="category_id">
           <option>
               <?php 
                $category = $categoryConnection->select(null);
                foreach($distritos as $value){                                                 
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }
               ?>           
           </option>
       </select>    
        <button onclick="sendData(insert_article,insert_article_form)" value="nuevo producto" name="submit"
        <?php         
        
   //         if(isset($store)){
      //
       // }
        ?>
       >nuevo producto</button>
       <button onclick="sendData(insert_article,insert_article_form)" value="nuevo producto" name="submit"
        <?php         
        
   //         if(isset($store)){
      //
       // }
        ?>
       >guardar borrador</button>
      </form>

</body>
</html>