<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/api/query/article.php');
require_once __DIR__.('/php/views/list_items/article_list_item.php');

$store = AuthUtil::getStoreSession(true);
$articleConnection = new Article();

$storeObject = json_decode(json_encode(array("id_store" => $store->id, "quantity" => 1000)));
$articles = $articleConnection->select_article($storeObject); 

$enabledArticles = array_filter($articles, function($val){
    return $val->enabled;
});

$disabledArticles = array_filter($articles, function($val){
    return !$val->enabled;
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="manifest" href="/manifest.json">
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::INVENTORY)) ?>

    <main class="main">
        <?= new HeaderView("Inventario", null, count($enabledArticles)." artículos publicados", count($disabledArticles)." artículos desactivados") ?>
        
        <div class="main__container unique">
            <article class="card">
                <?php foreach($articles as $value){ ?>
                    <?= new ArticleListItemView($value) ?>
                    <hr class="divider">
                <?php } ?>
            </article>
        </div>
        <?= new AsideButtonsView([new AsideSingleButtonView(
            'Publicar artículo', 
            'Añadir un nuevo artículo',
            'addarticle.php'
        )]) ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>