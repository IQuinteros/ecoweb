<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');
require_once __DIR__.('/../../views/article/rating.php');
require_once __DIR__.('/../../views/article/ecoindicator.php');

class ChatListItem extends BaseView{

    private Chat_model $chat;

    public function __construct(Chat_model $chat){
        $this->chat = $chat;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();

        $profileMessages = array_filter($this->chat->messages, function($val){
            return !$val->from_store;
        });

        ?>
        <button onclick="window.open('chat.php?id=<?= $this->chat->id ?>', '_self')" class="card btn chat">
            <h1 class="chat__name"><?= $this->chat->purchase->profile_name ?></h1>
            <p class="chat__message"><?= end($profileMessages)->message ?></p>
            <p class="chat__date"> <?= end($profileMessages)->creation_date ?> </p>
        </button>
        <?php
        return ob_get_clean();
    }

}
