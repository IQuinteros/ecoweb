<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/store_model.php');
require_once __DIR__.('/../../utils/auth_util.php');
require_once __DIR__.('/../../../api/query/district.php');

class MessageView extends BaseView{

    private string $message;
    private bool $owner;

    public function __construct(
        string $message,
        bool $owner = true
    ){
        $this->message = $message;
        $this->owner = $owner;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <button class="message <?= $this->owner? 'message--owner' : ''?>">
            <p><?= $this->message ?></p>
        </button>
        <?php
        return ob_get_clean();
    }

}
