<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once __DIR__.('/php/views/dashboard/appbar.php');
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
        <header class="main__header">
            <h1 class="header__title">Dashboard</h1>
        </header>
        
        <div class="main__container">
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Resumen de ventas</h1>
                    <a class="card__redirect" href="#">Ir a resumen</a>    
                </div>
                <div class="card__chart">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados</h1>
                    <a class="card__redirect" href="#">Ir a registros</a>
                </div>
                <h1 class="card__content card__content--unique">1.568</h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos más vendidos</h1>
                    <a class="card__redirect" href="#">Ir a registros</a>
                </div>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
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
        </aside>
    </main>

    <footer class="footer">
        <p>Somos ECOmercio, tu app de compras amigables</p>
    </footer>

</div>

<script src="js/script.js"></script>

</body>
</html>