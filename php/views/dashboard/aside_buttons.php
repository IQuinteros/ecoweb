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
    private array $additionalButtons = array();

    public function __construct(array $additionalButtons = []){
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

        $this->additionalButtons = $additionalButtons;

        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <aside class="buttons">
            <?= new AsideSingleButtonView(
                'Pedidos', 
                count($this->storePurchases ?? []).' pedidos hoy',
                'purchases.php',
                count($this->storePurchases) > 0
            )?>
            <?= new AsideSingleButtonView(
                'Chats', 
                count($this->storeChats ?? []).' nuevos mensajes',
                'chats.php',
                count($this->storeChats) > 0
            )?>
            <?= new AsideSingleButtonView(
                'Preguntas', 
                count($this->storeQuestions ?? []).' preguntas sin responder',
                'questions.php',
                count($this->storeQuestions) > 0
            )?>
            <?= new AsideSingleButtonView(
                'Valoraciones', 
                count($this->storeOpinions ?? []).' opiniones hoy',
                'rating.php',
            )?>
            <?php foreach($this->additionalButtons as $button){ ?>
                <?= $button ?>
            <?php } ?>
        </aside>
        <?php
        return ob_get_clean();
    }

}

class AsideSingleButtonView extends BaseView {

    private string $title;
    private string $subtitle;
    private bool $alert;
    private string $url;

    public function __construct(
        string $title,
        string $subtitle,
        string $url,
        bool $alert = false
    ){
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->alert = $alert;
        $this->url = $url;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
            <button class="card btn <?= $this->alert? 'btn--red' : ''?>" onclick="window.open('<?= $this->url ?>', '_self')">
                <h1><?= $this->title?></h1>
                <p><?= $this->subtitle?></p>
            </button>
        <?php
        return ob_get_clean();
    }
}