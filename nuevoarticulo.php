<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once('include.php');
require_once __DIR__.('/api/query/article.php');
$articleConnection = new article();
require_once __DIR__.('/api/query/article_form.php');
$article_formConnection = new article_form();
require_once __DIR__.('/api/query/category.php');
$categoryConnection = new category();
session_start();
$_SESSION["id"];
$general_detail = "";
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
    <script>
        function validar(form) {
            let elements = form.elements;
            let value;
            for (let i = 0; i < elements.length; i++) {
                if (elements[i].name == "recycled_mats") {
                    if (elements[i].checked) value = elements[i].value;
                }
            }

            if (value == "NINGUNO") {
                let elements = form.elements;
                let value;
                for (let i = 0; i < elements.length; i++) {
                    if (elements[i].name == "recycled_prod") {
                        if (elements[i].checked) value = elements[i].value;
                    }
                }

                if (value == "NINGUNO") {
                    var generaldetail = prompt("Info ecoamigable general");
                }
            }
            return false;
        }
    </script>
    <?php
    $general_detail = "<script type='text/javascript'> document.write(generaldetail); </script>";
    ?>
    <ul>
        <li><a href="home.php">home</a></li>
        <li><a href="pedidos.php">pedidos</a>
        <li>
        <li><a href="Chats.php">Chats</a>
        <li>
        <li><a href="preguntas.php">preguntas</a>
        <li>
        <li><a href="valoraciones.php">valoraciones</a>
        <li>
        <li><a href="inventario.php">inventario</a>
        <li>
        <li><a href="reportes.php">reportes</a>
        <li>
        <li><a href="perfil.php">perfil</a>
        <li>
    </ul>
    <form action="api/requests/example.php" method="POST" onsubmit="return validar(this)">
        <label for="title"> nombre del producto:</label>
        <input type="text" id="title" name="title"><br><br>
        <label for="description">description:</label>
        <input type="text" id="description" name="description"><br><br>
        <label for="price">precio:</label>
        <input type="text" id="price" name="price"><br><br>
        <label for="stock">stock:</label>
        <input type="text" id="stock" name="stock"><br><br>
        <label for="category_id">categoria:</label>
        <select id="category_id" name="category_id"><br><br>
            <option>
                <?php
                $category = $categoryConnection->select_category(null, null, null);
                foreach ($category as $value) {
                    echo "<option value='" . $value->id . "'>" . $value->title . "</option>";
                }
                ?>
            </option>
            
        </select><br><br>
        <label for="recycled_mats">¿que tanto es reciclado?:</label><br><br>
        <input type="radio" name="recycled_mats" value="TOTAL">TOTAL</input>
        <input type="radio" name="recycled_mats" value="PARCIAL">PARCIAL</input>
        <input type="radio" name="recycled_mats" value="NINGUNO">NINGUNO</input><br><br>


        <label for="recycled_mats_detail">da detalles al cliente:</label><br><br>
        <textarea name="recycled_mats_detail" placeholder="mensaje" id="recycled_mats_detail"></textarea><br><br>
        <label for="reuse_tips">¿en que se puede reutilizar el producto?:</label><br><br>
        <textarea name="reuse_tips" placeholder="mensaje" id="reuse_tips"></textarea><br><br>

        <label for="recycled_prod">que tanto puede ser reciclado:</label><br><br>
        <input type="radio" name="recycled_prod" value="TOTAL">TOTAL</input>
        <input type="radio" name="recycled_prod" value="PARCIAL">PARCIAL</input>
        <input type="radio" name="recycled_prod" value="NINGUNO">NINGUNO</input><br><br>
    </form><br><br>
    <label for="recycled_prod_detail">¿puede dar mas detalle?:</label><br><br>
    <textarea name="recycled_prod_detail" placeholder="mensaje" id="recycled_prod_detail"></textarea><br><br>
    <button value="submit" name="submit">nuevo producto</button>
    <?php
    if (isset($_POST['submit'])) {
        $recycled_mats = $_POST['recycled_mats'];
        $recycled_mats_detail = $_POST['recycled_mats_detail'];
        $reuse_tips = $_POST['reuse_tips'];
        $recycled_prod = $_POST['recycled_prod'];
        $recycled_prod_detail = $_POST['recycled_prod_detail'];
        $article_form = (json_decode(json_encode(array(
            "recycled_mats" => $recycled_mats, "recycled_mats_detail" => $recycled_mats_detail, "reuse_tips" => $reuse_tips, "recycled_prod" => $recycled_prod,
            "recycled_prod_detail" => $recycled_prod_detail
        ))));

        $insert_article_form = $article_formConnection->insert_article_form($article_form);
        return array($re, $user_id);
        $insert_article[1];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category_id = $_POST['category_id'];
        $store_id = $_SESSION["id"];

        $article_form_id = $insert_article[1];
        $article = (json_decode(json_encode(array(
            "title" => $title, "description" => $description, "price" => $price, "stock" => $stock, "category_id" => $category_id, "store_id" => $store_id,
            "article_form_id" => $article_form_id
        ))));
        $articleConnection->insert_article($article);
    } ?>
</body>

</html>