<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/list_items/purchase_list_item.php');
require_once __DIR__.('/api/query/purchase.php');
require_once __DIR__.('/php/utils/auth_util.php');

$store = AuthUtil::getStoreSession();

$purchaseConnection = new Purchase();
$purchases = $purchaseConnection->select_purchase(null);

$newResultPurchases = array();
foreach($purchases as $purchase){
    
    $purchase->articles = array_filter($purchase->articles, function($val) use ($store){
        return (isset($val->store_id) && $val->store_id == $store->id);
    });
    if(count($purchase->articles) > 0){
        array_push($newResultPurchases, $purchase);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>

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

    <?= new AppBarView(new AppBarSelected(AppBarSelected::PURCHASES)) ?>

    <main class="main">
        <?= new HeaderView("Pedidos", null, count($newResultPurchases)." pedidos en total") ?>
        
        <div class="main__container unique">
            <?php foreach($newResultPurchases as $purchase){ ?> 
                <?= new PurchaseListItem($purchase) ?>
            <?php } ?>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>