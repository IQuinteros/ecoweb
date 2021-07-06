<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
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

    <?= new AppBarView(new AppBarSelected(AppBarSelected::INVENTORY)) ?>

    <main class="main">
        <header class="main__header">
            <h1 class="header__title">Inventario</h1>
            <h2 class="header__subtitle header__subtitle--topright">50 artículos publicados</h2>
            <h2 class="header__subtitle header__subtitle--bottomright">5 artículos desactivados</h2>
        </header>
        
        <div class="main__container unique">
            <article class="card">
                <button class="list-item">
                    <img class="list-item__img" src="https://source.unsplash.com/random/1" alt="image">
                    <div class="list-item__content">
                        <div class="list-item__content__row">
                            <a class="list-item__content__title" href="editarticle.html">Nombre del producto completo</a>
                            <p>Publicado</p>
                        </div>
                        <div class="list-item__content__row">
                            <p class="w300">$45.000</p>
                            <div class="ecoindicator ecoindicator--linear">
                                <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                                <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                                <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                            </div>
                        </div>
                        <div class="list-item__content__row">
                            <p>2531 visualizaciones</p>
                            <div class="stars">
                                <span class="material-icons star--active">star</span>
                                <span class="material-icons star--active">star</span>
                                <span class="material-icons star--active">star</span>
                                <span class="material-icons star--active">star</span>
                                <span class="material-icons star--inactive">star</span>
                            </div>
                        </div>
                    </div>
                </button>
                <hr class="divider">
            </article>
        </div>
        <aside class="buttons">
            <button class="card btn btn--red">
                <h1>Pedidos</h1>
                <p>50 nuevos pedidos</p>
            </button>
            <button class="card btn">
                <h1>Chats</h1>
                <p>Sin nuevos mensajes</p>
            </button>
            <button class="card btn">
                <h1>Preguntas</h1>
                <p>Sin nuevas preguntas</p>
            </button>
            <button class="card btn btn--red">
                <h1>Valoraciones</h1>
                <p>50 nuevas opiniones</p>
            </button>
            <button class="card btn" onclick="window.open('/addarticle.html', '_self')">
                <h1>Añadir artículo</h1>
                <p>Publicar un nuevo artículo</p>
            </button>
        </aside>
    </main>

    <footer class="footer">
        <p>Somos ECOmercio, tu app de compras amigables</p>
    </footer>

</div>

<script src="js/script.js"></script>

</body>
</html>