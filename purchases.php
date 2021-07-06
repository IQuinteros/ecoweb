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
    <title>Purchases</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::PURCHASES)) ?>

    <main class="main">
        <?= new HeaderView("Pedidos", null, "8 pedidos hoy") ?>
        
        <div class="main__container unique">
            <article class="card card--purchase">
                <div class="purchase-list">
                    <h1>Pedido # 2031516</h1>
                    <div class="purchase-list__article">
                        <img src="https://source.unsplash.com/random/1" alt="">
                        <a href="#">Nombre del producto</a>
                        <p>3 unidades</p>
                    </div>
                    <div class="purchase-list__article">
                        <img src="https://source.unsplash.com/random/2" alt="">
                        <a href="#">Nombre del producto</a>
                        <p>3 unidades</p>
                    </div>
                </div>
                <div class="purchase-info">
                    <div class="purchase-info__header">
                        <p>Lunes 16 de Marzo de 2021</p>
                        <p>Hace 2 días</p>
                    </div>
                    <h2>Datos del cliente</h2>
                    <span><b>Nombre: </b>Nombre y apellido</span>
                    <span><b>Dirección: </b>Dirección completa del cliente con muchas palabras</span>
                    <span><b>Teléfono: </b>+569 12345678</span>

                    <a href="#">Ir al chat</a>

                    <p>Total: $450.000</p>
                </div>
            </article>
            <article class="card card--purchase">
                <div class="purchase-list">
                    <h1>Pedido # 2031516</h1>
                    <div class="purchase-list__article">
                        <img src="https://source.unsplash.com/random/1" alt="">
                        <a href="#">Nombre del producto</a>
                        <p>3 unidades</p>
                    </div>
                    <div class="purchase-list__article">
                        <img src="https://source.unsplash.com/random/2" alt="">
                        <a href="#">Nombre del producto</a>
                        <p>3 unidades</p>
                    </div>
                </div>
                <div class="purchase-info">
                    <div class="purchase-info__header">
                        <p>Lunes 16 de Marzo de 2021</p>
                        <p>Hace 2 días</p>
                    </div>
                    <h2>Datos del cliente</h2>
                    <span><b>Nombre: </b>Nombre y apellido</span>
                    <span><b>Dirección: </b>Dirección completa del cliente con muchas palabras</span>
                    <span><b>Teléfono: </b>+569 12345678</span>

                    <a href="#">Ir al chat</a>

                    <p>Total: $450.000</p>
                </div>
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