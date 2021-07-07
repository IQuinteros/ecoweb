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
    <title>Chats</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::CHATS)) ?>

    <main class="main">
        <?= new HeaderView("Chats", null, "12 nuevos mensajes") ?>
        
        <div class="main__container chat-main-container">
            <article class="card chat-list">
                <button class="chat-list__item">
                    <img src="https://source.unsplash.com/random/2" alt="">
                    <h1>Juan Pedro</h1>
                    <p>Hola! Sabes que necesito que</p>
                    <div class="chat-list__item__status"></div>
                </button>
                <hr class="divider">
                <button class="chat-list__item">
                    <img src="https://source.unsplash.com/random/2" alt="">
                    <h1>Juan Pedro</h1>
                    <p>Hola! Sabes que necesito que</p>
                    <div class="chat-list__item__status"></div>
                </button>
                <hr class="divider">
                <button class="chat-list__item">
                    <img src="https://source.unsplash.com/random/2" alt="">
                    <h1>Juan Pedro</h1>
                    <p>Hola! Sabes que necesito que</p>
                    <div class="chat-list__item__status"></div>
                </button>
            </article>
            <article class="card chat-messages">
                <div class="chat-list__item">
                    <img src="https://source.unsplash.com/random/2" alt="">
                    <h1>Juan Pedro</h1>
                    <p class="chat-messages__purchase-id">#000052</p>
                </div>
                <hr class="divider">

                <div class="chat-messages__list">
                    <button class="message">
                        <p>Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    </button>
                    <button class="message message--owner">
                        <p>Ok, en un momento se la enviamos</p>
                    </button>
                    <button class="message">
                        <p>Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    </button>
                    <button class="message message--owner">
                        <p>Ok, en un momento se la enviamos</p>
                    </button>
                    <button class="message">
                        <p>Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    </button>
                    <button class="message message--owner">
                        <p>Ok, en un momento se la enviamos</p>
                    </button>
                    <button class="message">
                        <p>Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    </button>
                    <button class="message message--owner">
                        <p>Ok, en un momento se la enviamos</p>
                    </button>
                    <button class="message">
                        <p>Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    </button>
                    <button class="message message--owner">
                        <p>Ok, en un momento se la enviamos</p>
                    </button>
                    <button class="message">
                        <p>Hola! Sabes que necesito que me des la factura por la compra. Rut: 11.111.111-1, Gracias</p>
                    </button>
                    <button class="message message--owner">
                        <p>Ok, en un momento se la enviamos</p>
                    </button>
                </div>
                
                <div class="input-container chat__input">
                    <input class="input" type="text" name="sendMsg" id="sendMsg" placeholder="Enviar mensaje">
                    <button class="input-container__button">
                        <span class="material-icons material-icons-outlined">send</span>
                    </button>
                </div>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>