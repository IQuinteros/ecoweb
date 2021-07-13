<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/article/edit_photo.php');
require_once __DIR__.('/php/views/article/ecoindicator.php');
require_once __DIR__.('/php/views/inputs/text_input.php');
require_once __DIR__.('/php/views/inputs/category_input.php');
require_once __DIR__.('/php/views/inputs/image_input.php');
require_once __DIR__.('/php/utils/article_util.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/php/utils/upload_util.php');
require_once __DIR__.('/api/query/article.php');
require_once __DIR__.('/api/query/photo.php');

if(!isset($_REQUEST['id'])){
    header('Location:inventory.php');
}

$store = AuthUtil::getStoreSession(true);

$articleId = $_REQUEST['id'];

$photosConnection = new Photo();
$articleConnection = new Article();
$foundArticles = $articleConnection->select_article(json_decode(json_encode(array("id" => $articleId, "id_store" => $store->id))));

if(count($foundArticles) <= 0){
    header('Location:inventory.php');
    return;
}
$article = function () use (&$foundArticles): Article_model { return $foundArticles[0]; };
$articleToDisplay = HtmlUtil::convertToHtmlSpecialObject($article());

if(isset($_POST['deleteimg'])){
    $imgId = (int)$_POST['deleteimg'];

    $foundImg = array_filter($article()->photos, function($val) use($imgId) {
        return $val->id == $imgId;
    });

    if(count($foundImg) > 0){
        $photosConnection->delete_photo($imgId);
        header('Location:editarticle.php?id='.$article()->id.'&deletedImg=true');
        return;
    }
}

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

    if(isset($_POST['enable'])){
        $data['enabled'] = $_POST['enable'] != 0? true : false;

        if(!$store->enabled){
            $articleData['enabled'] = false;
        }
    }
    
    $data['category_id'] = $_POST['category'];
    $data['past_price'] = $article()->price;
    $data['id'] = $article()->id;
    $articleConnection->update_article(json_decode(json_encode($data)));

    if(isset($_FILES['newImg'])){
        $result = UploadUtil::uploadImage('newImg', $article()->id);

        if($result->result){
            $data = array();
            $data['photo'] = $result->newFileUrl;
            $data['article_id'] = $article()->id;

            $photosConnection->insert_photo(json_decode(json_encode($data)));
        }
    }

    header('Location:editarticle.php?id='.$article()->id.'&success=true'.(isset($_POST['enable'])? '&enabled='.($_POST['enable'] != 0? 'true' : 'false'): ''));
    return;
}

if(isset($_REQUEST['delete'])){
    $articleConnection->delete_article($article()->id);
    header('Location:inventory.php');
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="manifest" href="/manifest.json">
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::NONE)) ?>

    <main class="main">
        <?= new HeaderView("Edición de producto", null, $article()->enabled? "Publicado" : "Desactivado") ?>
        
        <div class="main__container unique">
            <div class="main__article">
                <img class="main__article__img" src="<?= $article()->photos[0]->photo ?? 'assets/img/no-image-bg.png' ?>" alt="">
                <h1 class="main__article__title"><?= $articleToDisplay->title ?></h1>
                <h2 class="main__article__price">$ <?= $articleToDisplay->price ?></h2>
                <h2 class="main__article__subtitle"><?= $articleToDisplay->stock ?> en stock</h2>
                <?= new EcoIndicatorView(new ArticleEcoIndicator($article()))?>
            </div>
            <article class="card">
                <h1>Modifica datos</h1>

                <form action="editarticle.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $article()->id?>">
                    <?= new TextInputView('Descripción', 'description', 'description', 'Ingrese una descripción', $article()->description, true)?>
                    <?= new CategoryInputView($article()->category_id)?>
                    <?= new TextInputView('Precio', 'price', 'price', 'Ingrese un precio', $article()->price, false, true, 'number')?>
                    <?= new TextInputView('Stock disponible', 'stock', 'stock', 'Ingrese el stock disponible actual', $article()->stock, false, true, 'number')?>
                    
                    <div class="photos-container">
                        <?php foreach($article()->photos as $photo){ ?>
                            <?= new EditPhotoView($photo->photo, $photo->id) ?>
                        <?php } ?>
                        <?php if(count($article()->photos) < 4){ ?>
                            <?= new ImageInputView()?>
                        <?php } ?>
                    </div>

                    <div class="card__buttons">
                        <button type="submit" class="btn btn--primary">Solo guardar cambios</button>
                        <?php if($store->enabled){ ?>
                            <button type="submit" name="enable" value="<?= $article()->enabled? 0 : 1?>" class="btn btn--danger">Guardar y <?= $article()->enabled? 'Desactivar publicación' : 'Publicar artículo'?></button>
                        <?php } else {?>
                            <button class="btn btn--disabled" disabled>No puede publicar su artículo. Su cuenta aún no está activada</button>
                        <?php }?>

                    </div>
                </form>
            </article>
        </div>
        <?= new AsideButtonsView([new AsideSingleButtonView('Eliminar producto', 'Eliminar permamentemente el artículo', 'editarticle.php?id='.$article()->id.'&delete=true', true)]) ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

<?php if(isset($_REQUEST['success'])) {?>
    <?php 
        $enabled = $_REQUEST['enabled'] ?? null;
    ?>
    
    <script>
        displayAlert('Artículo modificado <?= $enabled != null? ($enabled == 'true'? 'y publicado': 'y desactivado') :''?>', 'Tu artículo ha sido modificado exitósamente', 'Volver');
    </script>
<?php } ?>
<?php if(isset($_REQUEST['new'])) {?>
    <script>
        displayAlert('Artículo publicado', 'Tu artículo ha sido publicado exitósamente', 'Volver');
    </script>
<?php } ?>
<?php if(isset($_REQUEST['saved'])) {?>
    <script>
        displayAlert('Artículo guardado', 'Tu artículo ha sido guardado exitósamente. Para publicarlo, presiona el botón para publicar', 'Volver');
    </script>
<?php } ?>
<?php if(isset($_REQUEST['deletedImg'])) {?>
    <script>
        displayAlert('Imagen eliminada', 'La imagen de tu artículo ha sido eliminada', 'Volver');
    </script>
<?php } ?>

</body>
</html>