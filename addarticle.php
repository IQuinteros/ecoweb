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
                    <?= new TextInputView('Nombre de producto completo', 'name', 'name', 'Ingrese un nombre')?>
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