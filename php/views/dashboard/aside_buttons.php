<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/store_model.php');
require_once __DIR__.('/../../utils/auth_util.php');
require_once __DIR__.('/../../../api/query/purchase.php');
require_once __DIR__.('/../../../api/query/chat.php');
require_once __DIR__.('/../../../api/query/article.php');

class AsideButtonsView extends BaseView{

    private ?Store_model $store;
    private array $storePurchases = array();
    private array $storeChats = array();
    private array $storeQuestions = array();
    private array $storeOpinions = array();

    public function __construct(){
        $this->store = AuthUtil::getStoreSession();
        $storeObj = json_decode(json_encode(array("store_id" => $this->store->id)));

        $purchasesConnection = new Purchase();
        $purchases = $purchasesConnection->select_purchase(null);

        foreach($purchases as $purchase){
            
            $purchase->articles = array_filter($purchase->articles, function($val){
                return (isset($val->store_id) && $val->store_id == $this->store->id);
            });
            if(count($purchase->articles) > 0){
                array_push($this->storePurchases, $purchase);
            }
        }
        // TODO: Filter for purchase -> Date today

        $chatConnection = new Chat();
        $this->storeChats = $chatConnection->select_chat($storeObj);
        // TODO: Filter for no seen messages

        $articleConnection = new Article();
        $articles = $articleConnection->select_article($storeObj);

        foreach($articles as $value){
            if($value->questions != null)
            $this->storeQuestions = array_merge($this->storeQuestions, $value->questions);
        }
        // Filter for no answer questions
        $this->storeQuestions = array_filter(
            $this->storeQuestions, function($value, $key)  { return $value->answer == null; },
            ARRAY_FILTER_USE_BOTH
        );

        // Opinions
        $this->storeOpinions = array_reduce($articles, function($acc, $value){ 
            return array_merge($acc, $value->opinions); 
        }, array());
        // TODO: Filter for today rating

        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <aside class="buttons">
            <button class="card btn <?= count($this->storePurchases) > 0? 'btn--red' : ''?>">
                <h1>Pedidos</h1>
                <p><?= count($this->storePurchases ?? []) ?> pedidos hoy</p>
            </button>
            <button class="card btn <?= count($this->storeChats) > 0? 'btn--red' : ''?>">
                <h1>Chats</h1>
                <p><?= count($this->storeChats)?> nuevos mensajes</p>
            </button>
            <button class="card btn <?= count($this->storeQuestions) > 0? 'btn--red' : ''?>">
                <h1>Preguntas</h1>
                <p><?= count($this->storeQuestions)?> preguntas sin responder</p>
            </button>
            <button class="card btn">
                <h1>Valoraciones</h1>
                <p><?= count($this->storeOpinions) ?> opiniones hoy</p>
            </button>
        </aside>
        <?php
        return ob_get_clean();
    }

}
