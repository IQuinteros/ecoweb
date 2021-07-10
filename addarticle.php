<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/inputs/text_input.php');
require_once __DIR__.('/php/views/inputs/category_input.php');
require_once __DIR__.('/php/views/inputs/image_input.php');
require_once __DIR__.('/php/views/inputs/check_group_input.php');
require_once __DIR__.('/php/views/article/edit_photo.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/php/utils/upload_util.php');
require_once __DIR__.('/api/query/article.php');
require_once __DIR__.('/api/query/photo.php');

$store = AuthUtil::getStoreSession();
$articleConnection = new Article();
$articleFormConnection = new Article_form();

if(
    isset($_POST['recycledMats']) &&
    isset($_POST['recycledMatsDetail']) &&
    isset($_POST['generalDetail']) &&
    isset($_POST['reuseTips']) &&
    isset($_POST['recycledProd']) &&
    isset($_POST['recycledProdDetail']) &&
    isset($_POST['title']) &&
    isset($_POST['description']) &&
    isset($_POST['price']) &&
    isset($_POST['stock']) &&
    isset($_POST['enabled']) &&
    isset($_POST['category'])
){
    $articleFormData = array();
    $articleFormData['recycled_mats'] = $_POST['recycledMats'];
    $articleFormData['recycled_mats_detail'] = $_POST['recycledMatsDetail'];
    $articleFormData['general_detail'] = $_POST['generalDetail'];
    $articleFormData['reuse_tips'] = $_POST['reuseTips'];
    $articleFormData['recycled_prod'] = $_POST['recycledProd'];
    $articleFormData['recycled_prod_detail'] = $_POST['recycledProdDetail'];

    $resultForm = $articleFormConnection->insert_article_form(json_decode(json_encode($articleFormData)));

    if(count($resultForm) <= 0){
        header('Location:addarticle.php');
        return;
    }

    $articleData = array();
    $articleData['title'] = $_POST['title'];
    $articleData['description'] = $_POST['description'];
    $articleData['price'] = $_POST['price'];
    $articleData['stock'] = $_POST['stock'];
    $articleData['enabled'] = $_POST['enabled'];
    $articleData['category_id'] = $_POST['category'];
    $articleData['store_id'] = $store->id;
    $articleData['article_form_id'] = $resultForm[0];

    $resultArticle = $articleConnection->insert_article(json_decode(json_encode($articleData)));

    if(count($resultArticle) <= 0){
        header('Location:addarticle.php');
        return;
    }

    if(isset($_FILES['newImg'])){
        $result = UploadUtil::uploadImage('newImg', $resultArticle[0]);

        if($result->result){
            $photosConnection = new Photo();

            $data = array();
            $data['photo'] = $result->newFileUrl;
            $data['article_id'] = $resultArticle[0];

            $photosConnection->insert_photo(json_decode(json_encode($data)));
        }
    }

    header('Location:editarticle.php?id='.$resultArticle[0]);
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo producto</title>

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
        <?= new HeaderView("Nuevo producto") ?>
        
        <div class="main__container unique">
            <article class="card">
                <form action="addarticle.php" method="post" enctype="multipart/form-data">
                    <?= new TextInputView('Nombre de producto completo', 'title', 'title', 'Ingrese un nombre')?>
                    <?= new CategoryInputView()?>
                    <?= new TextInputView('Descripción', 'description', 'description', 'Ingrese una descripción')?>
                    <?= new TextInputView('Precio', 'price', 'price', 'Ingrese un precio')?>
                    <?= new TextInputView('Stock disponible', 'stock', 'stock', 'Ingrese el stock disponible actual')?>
                    
                    <div class="photos-container">
                        <?= new ImageInputView() ?>
                    </div>

                    <h1>Destaca lo ecológico de tu producto</h1>

                    <h3 class="card__subtitle">¿Se emplearon materiales reciclados y/o reutilizados para desarrollar tu producto?</h3>

                    <?= new CheckGroupInput('recycledMats')?>

                    <?= new TextInputView('', 'recycledMatsDetail', 'recycledProdDetail', 'Da más detalles a tus clientes', '', true)?>

                    <h3 class="card__subtitle">¿En qué se puede reutilizar tu producto?</h3>

                    <?= new TextInputView('', 'reuseTips', 'reuseTips', 'Da tips a tus clientes sobre cómo pueden reutilizar tu producto o envoltorio para evitar que lo desechen', '', true)?>

                    <h3 class="card__subtitle">¿El producto se puede reciclar?</h3>

                    <?= new CheckGroupInput('recycledProd')?>

                    <?= new TextInputView('', 'recycledProdDetail', 'recycledProdDetail', 'Da más detalles a tus clientes', '', true)?>

                    <input type="hidden" name="generalDetail">
                    <input type="hidden" name="enabled">
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