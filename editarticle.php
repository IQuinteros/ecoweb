<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/article/edit_photo.php');
require_once __DIR__.('/php/views/article/ecoindicator.php');
require_once __DIR__.('/php/utils/article_util.php');
require_once __DIR__.('/api/query/article.php');

if(!isset($_REQUEST['id'])){
    header('Location:inventory.php');
}

$articleId = $_REQUEST['id'];

$articleConnection = new Article();
$foundArticles = $articleConnection->select_article(json_decode(json_encode(array("id" => $articleId))));

$article = function () use (&$foundArticles): Article_model { return $foundArticles[0]; }

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
                <div class="input-container">
                    <label class="input-label">
                        Descripción
                        <input class="input" type="text" placeholder="Ingrese la descripción" value="<?= $article()->description ?>">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Categoría
                        <select class="input" name="category" id="category">
                            <option value="2" <?= $article()->category_id == 2? 'selected' : '' ?>>Hogar</option>
                            <option value="1" <?= $article()->category_id == 1? 'selected' : '' ?>>Cuidado personal</option>
                            <option value="3" <?= $article()->category_id == 3? 'selected' : '' ?>>Alimentos</option>
                            <option value="4" <?= $article()->category_id == 4? 'selected' : '' ?>>Vestimenta</option>
                        </select>
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Precio
                        <input class="input" type="text" placeholder="Ingrese un precio" value="<?= $article()->price ?>">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Stock disponible
                        <input class="input" type="text" placeholder="Ingrese el stock disponible actual" value="<?= $article()->stock ?>">
                    </label>
                </div>
                
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
                    <button class="btn btn--primary">Publicar producto</button>
                    <button class="btn btn--primary">Guardar borrador</button>
                </div>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>