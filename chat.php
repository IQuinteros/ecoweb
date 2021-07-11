<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/chat/message.php');
require_once __DIR__.('/php/views/chat/chat_item.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/api/query/chat.php');
require_once __DIR__.('/api/query/message.php');
require_once __DIR__.('/api/query/profile.php');

$store = AuthUtil::getStoreSession();
$chatConnection = new Chat();

$storeObject = json_decode(json_encode(array("id"=>null,"closed"=>null,"store_id" => $store->id)));
$chats = $chatConnection->select_chat($storeObject);

$selectedChat = null;

if(isset($_REQUEST['id'])){
    $chatId = $_REQUEST['id'];
    $foundChats = array_filter($chats, function($val) use ($chatId){
        return $val->id == $chatId;
    });

    if(count($foundChats) > 0) $selectedChat = end($foundChats);
} else if(isset($_REQUEST['purchaseid'])){
    $purchaseId = $_REQUEST['purchaseid'];
    $foundChats = array_filter($chats, function($val) use ($purchaseId){
        return $val->purchase_id == $purchaseId;
    });

    if(count($foundChats) > 0) $selectedChat = end($foundChats);
}

if($selectedChat != null && isset($_POST['sendMsg']) && !empty($_POST['sendMsg'])){
    $messageConnection = new Message();
    $data = array();
    $data['chat_id'] = $selectedChat->id;
    $data['message'] = $_POST['sendMsg'];
    $messageConnection->insert_message(json_decode(json_encode($data)), true);

    header('Location:chat.php?id='.$selectedChat->id);
    return;
}

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
                    <h1><?= $selectedChat->purchase->profile_name ?? 'Seleccione un chat' ?></h1>
                    <p class="chat-messages__purchase-id"><?= $selectedChat != null? 'Pedido #'.$selectedChat->purchase_id ?? '?' : 'No ha seleccionado un chat'?></p>
                </div>
                <hr class="divider">

                <div id="chatMessagesList" class="chat-messages__list">
                    <?php if(isset($selectedChat->messages) && $selectedChat->messages != null){?>
                        <?php foreach($selectedChat->messages as $message){ ?>
                            <?= new MessageView($message->message, $message->from_store) ?>
                        <?php } ?>
                    <?php } ?>
                </div>

                <script>
                    let chatMessagesList = document.getElementById('chatMessagesList');
                    chatMessagesList.scrollTop = chatMessagesList.scrollHeight;
                </script>
                
                <?php if($selectedChat != null){ ?>
                    <form action="chat.php" method="POST">
                        <input type="hidden" name="id" value="<?= $selectedChat->id ?>">
                        <div class="input-container chat__input">
                            <input class="input" type="text" name="sendMsg" id="sendMsg" placeholder="Enviar mensaje" required>
                            <button type="submit" class="input-container__button">
                                <span class="material-icons material-icons-outlined">send</span>
                            </button>
                        </div>
                    </form>
                <?php }?>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>