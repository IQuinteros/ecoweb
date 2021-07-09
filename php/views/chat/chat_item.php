<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/store_model.php');
require_once __DIR__.('/../../utils/auth_util.php');
require_once __DIR__.('/../../../api/query/district.php');

class ChatItemView extends BaseView{

    private Chat_model $chat;

    public function __construct(
        Chat_model $chat
    ){
        $this->chat = $chat;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <button class="chat-list__item" onclick="window.open('chat.php?id=<?= $this->chat->id?>', '_self')">
            <img src="https://source.unsplash.com/random/2" alt="">
            <h1><?= $this->chat->purchase->profile_name ?></h1>

            <?php
            $profileMessages = array_filter($this->chat->messages, function($value, $key){
                return !$value->from_store;
            }, ARRAY_FILTER_USE_BOTH)
            ?>
            
            <p><?= end($profileMessages)->message ?? 'Sin mensaje'?></p>
            <div class="chat-list__item__status"></div>
        </button>
        <?php
        return ob_get_clean();
    }

}
