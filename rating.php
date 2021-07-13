<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/api/query/article.php');
require_once __DIR__.('/php/views/list_items/opinion_list_item.php');

$articleConnection = new Article();
$store = AuthUtil::getStoreSession(true);

$storeObject = json_decode(json_encode(array("id_store" => $store->id)));
$articles = $articleConnection->select_article($storeObject);

$opinions = array_reduce($articles, function($acc, $value){ 
    return array_merge($acc, $value->opinions); 
}, array());

$positiveOpinions = array_filter($opinions, function($value, $key){
    return $value->rating >= 4;
}, ARRAY_FILTER_USE_BOTH);

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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="manifest" href="/manifest.json">
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::RATING)) ?>

    <main class="main">
        <?= new HeaderView(
            "Valoraciones a tus productos", 
            count($positiveOpinions)." valoraciones positivas en total", 
            //"88 nuevas valoraciones hoy", 
            count($opinions)." valoraciones en total"
        ) ?>
        
        <div class="main__container unique">
            <article class="card">
                <?php foreach($articles as $articleRef) {?>
                    <?php foreach($articleRef->opinions as $opinionRef) {?>
                    
                        <?= new OpinionListItemView($opinionRef, $articleRef)?>
                        <hr class="divider">

                    <?php } ?>
                <?php } ?>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>