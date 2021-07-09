<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/article/article_card.php');
require_once __DIR__.('/php/views/chart/chart.php');
require_once __DIR__.('/api/query/article_purchase.php');
require_once __DIR__.('/api/query/profile.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/php/utils/date_util.php');

$store = AuthUtil::getStoreSession();
$storeObj = json_decode(json_encode(array("store_id" => $store->id)));

$profileConnection = new Profile();
$registeredUsers = $profileConnection->report_user_registered(null);

$articlePurchaseConnection = new Article_purchase();
$sellsSummary = $articlePurchaseConnection->report_sells_by_months($storeObj);
$articlesMostSelled = $articlePurchaseConnection->report_most_selled($storeObj);
$articlesMostSelled = array_slice($articlesMostSelled, 0, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::HOME)) ?>

    <main class="main">
        <?= new HeaderView("Dashboard") ?>
        
        <div class="main__container">
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Resumen de ventas</h1>
                    <a class="card__redirect" href="#">Ir a resumen</a>    
                </div>
                <div class="card__chart">
                    <?= new ChartView(
                        "Ventas", 
                        "sellsChart",
                        array_map(function ($value){
                            return DateUtil::numberToMonth($value["month"]);
                        }, $sellsSummary),
                        array_map(function ($value){
                            return $value["contador"];
                        }, $sellsSummary), 
                    )?>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados</h1>
                    <a class="card__redirect" href="#">Ir a registros</a>
                </div>
                <h1 class="card__content card__content--unique"><?= $registeredUsers[0] ?? '0'?></h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos más vendidos</h1>
                    <a class="card__redirect" href="#">Ir a registros</a>
                </div>
                <?php foreach($articlesMostSelled as $article){ ?>
                    <?= isset($article["article"])? new ArticleCardView($article["article"]) : ''?>
                <?php } ?>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Últimos mensajes</h1>
                    <a class="card__redirect" href="#">Ir a chats</a>
                </div>
                <button class="card btn chat">
                    <h1 class="chat__name">Nombre y apellido</h1>
                    <p class="chat__message">Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    <p class="chat__date">Hace 2 días, sin reponder</p>
                </button>
                <button class="card btn chat">
                    <h1 class="chat__name">Nombre y apellido</h1>
                    <p class="chat__message">Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    <p class="chat__date">Hace 2 días, sin reponder</p>
                </button>
                <button class="card btn chat">
                    <h1 class="chat__name">Nombre y apellido</h1>
                    <p class="chat__message">Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    <p class="chat__date">Hace 2 días, sin reponder</p>
                </button>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Últimos pedidos</h1>
                    <a class="card__redirect" href="#">Ir a pedidos</a>
                </div>
                <button class="card btn purchase">
                    <h1 class="purchase__quantity">3 artículos</h1>
                    <p class="purchase__status">Enviado</p>
                    <p class="purchase__date">Hace 2 días</p>
                </button>
                <button class="card btn purchase btn--red">
                    <h1 class="purchase__quantity">5 artículos</h1>
                    <p class="purchase__status">Sin revisar</p>
                    <p class="purchase__date">Hace 1 día</p>
                </button>
                <button class="card btn purchase">
                    <h1 class="purchase__quantity">3 artículos</h1>
                    <p class="purchase__status">Enviado</p>
                    <p class="purchase__date">Hoy</p>
                </button>
            </article>
        </div>

        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>