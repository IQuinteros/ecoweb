<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/chart/chart.php');
require_once __DIR__.('/php/views/article/article_card.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/php/utils/date_util.php');
require_once __DIR__.('/api/query/profile.php');
require_once __DIR__.('/api/query/store.php');
require_once __DIR__.('/api/query/search.php');
require_once __DIR__.('/api/query/history_detail.php');
require_once __DIR__.('/api/query/article_purchase.php');
require_once __DIR__.('/api/query/favorite.php');
require_once __DIR__.('/api/query/history.php');

$store = AuthUtil::getStoreSession();
$storeObj = json_decode(json_encode(array("store_id" => $store->id)));

$profileConnection = new Profile();
$registeredUsers = $profileConnection->report_user_registered(null);
$usersPerDistricts = $profileConnection->report_user_registered_district(null);
$usersPerAge = $profileConnection->report_user_resgistered_ages(null);

$storeConnection = new Store();
$registeredStores = $storeConnection->report_registered_stores(null);

$articlePurchaseConnection = new Article_purchase();
$sellsSummary = $articlePurchaseConnection->report_sells_by_months($storeObj);
$articlesMostSelled = $articlePurchaseConnection->report_most_selled($storeObj);
$articlesMostSelled = array_slice($articlesMostSelled, 0, 5);

$historyDetailConnection = new History_detail();
$visualizationsResult = $historyDetailConnection->report_most_visualized($storeObj);
$totalVisualizations = array_reduce($visualizationsResult, function ($acc, $value){
    return $acc += $value["contador"];
}, 0);

$favoriteConnection = new Favorite();
$mostFavorites = $favoriteConnection->report_favorite($storeObj);

$historyConnection = new History();
$mostVisited = $historyConnection->report_most_visited($storeObj);

$searchConnection = new Search();
$mostSearch = $searchConnection->report_search();
$mostSearch = array_slice($mostSearch, 0, 7);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>

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

    <?= new AppBarView(new AppBarSelected(AppBarSelected::REPORTS)) ?>

    <main class="main">
        <?= new HeaderView("Reportes") ?>
        
        <div class="main__container">
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Monto de ventas</h1> 
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
                </div>
                <h1 class="card__content card__content--unique"><?= $registeredUsers[0] ?? '0'?></h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Cantidad de visualizaciones de tus artículos</h1>
                </div>
                <h1 class="card__content card__content--unique"><?= $totalVisualizations ?></h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Tiendas registradas</h1>
                </div>
                <h1 class="card__content card__content--unique"><?= $registeredStores[0] ?? '0'?></h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados por comuna</h1> 
                </div>
                <div class="card__chart">
                    <?= new ChartView(
                        "Usuarios", 
                        "districtChart",
                        array_map(function ($value){
                            return $value["district_name"];
                        }, $usersPerDistricts),
                        array_map(function ($value){
                            return $value["contador"];
                        }, $usersPerDistricts), 
                    )?>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados por edad</h1> 
                </div>
                <div class="card__chart">
                    <?= new ChartView(
                        "Usuarios", 
                        "ageChart",
                        array_map(function ($value){
                            return $value["rango"];
                        }, $usersPerAge),
                        array_map(function ($value){
                            return $value["contador"];
                        }, $usersPerAge), 
                    )?>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Lo que buscan los usuarios</h1> 
                </div>
                <div class="card__chart">
                    <?= new ChartView(
                        "Búsquedas", 
                        "searchChart",
                        array_map(function ($value){
                            return $value["search_text"];
                        }, $mostSearch),
                        array_map(function ($value){
                            return $value["contador"];
                        }, $mostSearch), 
                    )?>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos más vendidos</h1>
                </div>
                <?php foreach($articlesMostSelled as $article){ ?>
                    <?= isset($article["article"])? new ArticleCardView($article["article"]) : ''?>
                <?php } ?>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos más visitados</h1>
                </div>
                <?php foreach($mostVisited as $article){ ?>
                    <?= isset($article["article"])? new ArticleCardView($article["article"]) : ''?>
                <?php } ?>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos con más favoritos</h1>
                </div>
                <?php foreach($mostFavorites as $article){ ?>
                    <?= isset($article["article"])? new ArticleCardView($article["article"]) : ''?>
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