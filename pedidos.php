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
    require_once __DIR__ . ('/api/query/purchase.php');
    $purchaseConnection = new purchase();
    require_once __DIR__ . ('/api/query/article_purchase.php');
    $article_purchaseConnection = new article_purchase();
    require_once __DIR__ . ('/api/query/profile.php');
    $profileConnection = new profile();
    require_once __DIR__ . ('/api/query/chat.php');
    $chatConnection = new chat();
    require_once('include.php');
    session_start();
    $id = $_SESSION['id'];
    $_SESSION["profile"];
    $_SESSION["id_chat"];
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
    <?php
    $objet = (json_decode(json_encode(array("store_id" => $id))));
    $article_purchase = $article_purchaseConnection->select_article_purchase($objet);

    foreach ($article_purchase as $value) { ?>
        <?php
        echo  "#" . $value->id ?><br><br><?php
                                            $purchase = $purchaseConnection->select_purchase((json_decode(json_encode(array("id" => $value->purchase_id)))));
                                            echo "Fecha del pedido : " . $purchase[0]->creation_date; ?><br><br>

        <?php echo " producto : " . $value->title   ?><br><br>
        <?php echo "cantidad : " . $value->quantity; ?><br><br>
        <?php
        $profile = $profileConnection->select_profile(json_decode(json_encode(array("id" => $purchase[0]->profile_id))));

        echo " Datos del Cliente"; ?><br><br>
        <?php
        echo "Nombre : " . $profile[0]->name . " " . $profile[0]->last_name; ?><br><br>
        <?php
        echo "Direccion :" . $profile[0]->location; ?><br><br>
        <?php
        echo "Telefono :" . $profile[0]->contact_number;
        $chat = $chatConnection->select_chat(json_decode(json_encode(array("purchase_id" => $purchase[0]->id))));
        $chat_id = $chat[0]->id;
        $profi = $profile[0]->id
        ?>

        <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method="POST" id="ir chat">
           
            <a type="text" href='Chats.php'" value="submit" name="submit">ir al chat</a>
        </form>
        <?php
        echo " Total : " . $purchase[0]->total; ?><br><br>
    <?php

        if (isset($_POST['submit'])) {

            $_SESSION["profile"] = $profi;
            $_SESSION["id_chat"] = $chat_id;
        }
    }

    ?>



</body>



</html>