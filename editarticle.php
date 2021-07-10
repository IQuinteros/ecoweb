<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/article/edit_photo.php');
require_once __DIR__.('/php/views/article/ecoindicator.php');
require_once __DIR__.('/php/views/inputs/text_input.php');
require_once __DIR__.('/php/views/inputs/category_input.php');
require_once __DIR__.('/php/utils/article_util.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/api/query/article.php');

if(!isset($_REQUEST['id'])){
    header('Location:inventory.php');
}

$store = AuthUtil::getStoreSession();

$articleId = $_REQUEST['id'];

$articleConnection = new Article();
$foundArticles = $articleConnection->select_article(json_decode(json_encode(array("id" => $articleId, "id_store" => $store->id))));

if(count($foundArticles) <= 0){
    header('Location:inventory.php');
    return;
}
$article = function () use (&$foundArticles): Article_model { return $foundArticles[0]; };

if(
    isset($_POST['description']) &&
    isset($_POST['category']) &&
    isset($_POST['price']) &&
    isset($_POST['stock'])
){
    $data = array();
    $data['title'] = $article()->title;
    $data['description'] = $_POST['description'];
    $data['price'] = $_POST['price'];
    $data['stock'] = $_POST['stock'];
    $data['enabled'] = $article()->enabled;
    $data['category_id'] = $_POST['category'];
    $data['past_price'] = $article()->price;
    $data['id'] = $article()->id;
    $articleConnection->update_article(json_decode(json_encode($data)));

    header('Location:editarticle.php?id='.$article()->id);
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::NONE)) ?>

    <main class="main">
        <?= new HeaderView("Edición de producto", null, "Publicado") ?>
        
        <div class="main__container unique">
            <div class="main__article">
                <img class="main__article__img" src="<?= $article()->photos[0]->photo ?? 'assets/img/no-image-bg.png' ?>" alt="">
                <h1 class="main__article__title"><?= $article()->title ?></h1>
                <h2 class="main__article__price">$ <?= $article()->price ?></h2>
                <h2 class="main__article__subtitle"><?= $article()->stock ?> en stock</h2>
                <?= new EcoIndicatorView(new ArticleEcoIndicator($article()))?>
            </div>
            <article class="card">
                <h1>Modifica datos</h1>

                <form action="editarticle.php" method="POST">
                    <input type="hidden" name="id" value="<?= $article()->id?>">
                    <?= new TextInputView('Descripción', 'description', 'description', 'Ingrese una descripción', $article()->description)?>
                    <?= new CategoryInputView($article()->category_id)?>
                    <?= new TextInputView('Precio', 'price', 'price', 'Ingrese un precio', $article()->price)?>
                    <?= new TextInputView('Stock disponible', 'stock', 'stock', 'Ingrese el stock disponible actual', $article()->stock)?>
                    
                    <div class="photos-container">
                        <?php foreach($article()->photos as $photo){ ?>
                            <?= new EditPhotoView($photo->photo) ?>
                        <?php } ?>
                        <?php if(count($article()->photos) < 4){ ?>
                        <button class="btn picker">
                            <span class="picker__icon material-icons material-icons-outlined">file_upload</span>
                            <span class="picker__text">Subir nueva imagen</span>
                        </button>
                        <?php } ?>
                    </div>

                    <div class="card__buttons">
                        <button type="submit" class="btn btn--primary">Publicar producto</button>
                        <button type="button" class="btn btn--primary">Guardar borrador</button>
                    </div>
                </form>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>