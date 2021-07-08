<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/chat/message.php');
require_once __DIR__.('/php/views/chat/chat_item.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/api/query/chat.php');
require_once __DIR__.('/api/query/profile.php');

$store = AuthUtil::getStoreSession();
$chatConnection = new Chat();

$storeObject = json_decode(json_encode(array("id"=>null,"closed"=>null,"store_id" => $store->id)));
$chats = $chatConnection->select_chat($storeObject);

$chat = new Chat_model();

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
        <?= new HeaderView("Chats", null, count($chats)." nuevos mensajes") ?>
        
        <div class="main__container chat-main-container">
            <article class="card chat-list">
                <?php foreach($chats as $chatRef){?>
                    <?= new ChatItemView($chatRef)?>
                    <hr class="divider">
                <?php } ?>
            </article>
            <article class="card chat-messages">
                <div class="chat-list__item">
                    <img src="https://source.unsplash.com/random/2" alt="">
                    <h1>Juan Pedro</h1>
                    <p class="chat-messages__purchase-id">#<?= $chat->purchase_id ?? 'Inválido'?></p>
                </div>
                <hr class="divider">

                <div class="chat-messages__list">
                    <?php if(isset($chat->messages) && $chat->messages != null){?>
                        <?php foreach($chat->messages as $message){ ?>
                            <?= new MessageView($message->message, $message->from_store) ?>
                        <?php } ?>
                    <?php } ?>
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