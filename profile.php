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
    <title>Profile</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::PROFILE)) ?>

    <main class="main">
        <header class="main__header">
            <h1 class="header__title">Perfil</h1>
            <h2 class="header__subtitle header__subtitle--topright">8 pedidos hoy</h2>
        </header>
        
        <div class="main__container unique">
            <div class="main__profile">
                <img class="main__profile__img" src="https://source.unsplash.com/random/2" alt="">
                <h1 class="main__profile__title">Empresa HH</h1>
                <h2 class="main__profile__subtitle">Ingresa una glosa</h2>
                <button class="main__profile__btn">
                    <span class="material-icons material-icons-outlined">edit</span>
                </button>
            </div>
            <article class="card profile__data">
                <h1>Modifica datos</h1>

                <div class="input-container">
                    <label class="input-label">
                        Comuna
                        <input class="input" type="text" placeholder="Ingrese la comuna">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Dirección
                        <input class="input" type="text" placeholder="Ingrese la dirección">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Email
                        <input class="input" type="text" placeholder="Ingrese el email">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Número de contacto
                        <input class="input" type="text" placeholder="Ingrese el número de contacto">
                    </label>
                </div>

                <div class="card__buttons">
                    <button class="btn btn--primary">Guardar cambios</button>
                    <button class="btn btn--primary">Cambiar contraseña</button>
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