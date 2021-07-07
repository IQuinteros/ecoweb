<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
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
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::QUESTIONS)) ?>

    <main class="main">
        <?= new HeaderView("Preguntas", "58 preguntas sin responder", null, "100 preguntas en total") ?>
        
        <div class="main__container unique">
            <article class="card">
                <button class="list-item">
                    <img class="list-item__img" src="https://source.unsplash.com/random/1" alt="image">
                    <div class="list-item__content">
                        <div class="list-item__content__row">
                            <a class="list-item__content__title" href="#">Nombre del producto completo</a>
                            <p>Hoy</p>
                        </div>
                        <div class="list-item__content__row">
                            <p class="w300">Nombre y apellido</p>
                        </div>
                        <div class="list-item__content__row">
                            <p>¿Cuál es la pregunta que estoy preguntando?</p>
                            <a href="#">Responder</a>
                        </div>
                    </div>
                </button>
                <hr class="divider">
                
                <hr class="divider">
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>