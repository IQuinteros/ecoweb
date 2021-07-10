<?php
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
    $articleFormData['recycled_mats'] = !empty($_POST['recycledMats'])? $_POST['recycledMats'] : null;
    $articleFormData['recycled_mats_detail'] = !empty($_POST['recycledMatsDetail'])? $_POST['recycledMatsDetail'] : null;
    $articleFormData['general_detail'] = !empty($_POST['generalDetail'])? $_POST['generalDetail']: null;
    $articleFormData['reuse_tips'] = !empty($_POST['reuseTips'])? $_POST['reuseTips']: null;
    $articleFormData['recycled_prod'] = !empty($_POST['recycledProd'])? $_POST['recycledProd']: null;
    $articleFormData['recycled_prod_detail'] = !empty($_POST['recycledProdDetail'])? $_POST['recycledProdDetail']: null;

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
    $articleData['enabled'] = $_POST['enabled'] != 0? true : false;
    $articleData['category_id'] = $_POST['category'];
    $articleData['store_id'] = $store->id;
    $articleData['article_form_id'] = $resultForm[0];

    if(!$store->enabled){
        $articleData['enabled'] = false;
    }

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

    header('Location:editarticle.php?id='.$resultArticle[0].($articleData['enabled']? '&new=true' : '&saved=true'));
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
                    <?= new TextInputView('Nombre de producto completo', 'title', 'title', 'Ingrese un nombre', '')?>
                    <?= new CategoryInputView()?>
                    <?= new TextInputView('Descripción', 'description', 'description', 'Ingrese una descripción')?>
                    <?= new TextInputView('Precio', 'price', 'price', 'Ingrese un precio', '', false, true, 'number')?>
                    <?= new TextInputView('Stock disponible', 'stock', 'stock', 'Ingrese el stock disponible actual', '', false, true, 'number')?>
                    
                    <div class="photos-container">
                        <?= new ImageInputView() ?>
                    </div>

                    <h1>Destaca lo ecológico de tu producto</h1>

                    <h3 class="card__subtitle">¿Se emplearon materiales reciclados y/o reutilizados para desarrollar tu producto?</h3>

                    <?= new CheckGroupInput('recycledMats')?>

                    <?= new TextInputView('', 'recycledMatsDetail', 'recycledProdDetail', 'Da más detalles a tus clientes', '', true, false)?>

                    <h3 class="card__subtitle">¿En qué se puede reutilizar tu producto?</h3>

                    <?= new TextInputView('', 'reuseTips', 'reuseTips', 'Da tips a tus clientes sobre cómo pueden reutilizar tu producto o envoltorio para evitar que lo desechen', '', true, false)?>

                    <h3 class="card__subtitle">¿El producto se puede reciclar?</h3>

                    <?= new CheckGroupInput('recycledProd')?>

                    <?= new TextInputView('', 'recycledProdDetail', 'recycledProdDetail', 'Da más detalles a tus clientes', '', true, false)?>

                    <input type="hidden" name="generalDetail">
                    <div class="card__buttons">
                        <?php if($store->enabled) {?>
                            <button type="submit" name="enabled" value="1" class="btn btn--primary">Publicar producto</button>
                            <button type="submit" name="enabled" value="0" class="btn btn--primary">Guardar borrador</button>
                        <?php } else {?>
                            <button type="submit" name="enabled" value="0" class="btn btn--primary">Guardar borrador</button>
                            <button class="btn btn--disabled" disabled>Por el momento, solo puede guardar su artículo como borrador. Su cuenta aún no está activada para publicar el producto</button>
                        <?php } ?>
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