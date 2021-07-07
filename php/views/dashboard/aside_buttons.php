<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/store_model.php');
require_once __DIR__.('/../../utils/auth_util.php');

class AsideButtonsView extends BaseView{

    private ?Store_model $store;

    public function __construct(){
        $this->store = AuthUtil::getStoreSession();
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
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
        <?php
        return ob_get_clean();
    }

}
