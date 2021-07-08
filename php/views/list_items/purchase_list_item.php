<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');
require_once __DIR__.('/../../views/article/rating.php');
require_once __DIR__.('/../../views/article/ecoindicator.php');

class ArticleListItemView extends BaseView{

    private Purchase_model $purchase;

    public function __construct(Purchase_model $purchase){
        $this->purchase = $purchase;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <article class="card card--purchase">
            <div class="purchase-list">
                <h1>Pedido # <?= $this->purchase->id ?></h1>
                <?php foreach($this->purchase->articles as $article) {?>
                    <div class="purchase-list__article">
                        <img src="<?= $article->photo_url ?? 'assets/no-image-bg.png' ?>" alt="">
                        <a href="#"><?= $article->title ?></a>
                        <p><?= $article->quantity ?> unidades</p>
                    </div>
                <?php } ?>
            </div>
            <div class="purchase-info">
                <div class="purchase-info__header">
                    <p><?= $this->purchase->creation_date ?></p>
                    <p>Hace 2 días</p>
                </div>
                <h2>Datos del cliente</h2>
                <span><b>Nombre: </b><?= $this->purchase->info_purchase->names ?? 'No determinado' ?></span>
                <span><b>Dirección: </b><?= ($this->purchase->info_purchase->location ?? 'No determinado').", ".($this->purchase->info_purchase->district ?? '') ?></span>
                <span><b>Teléfono: </b><?= $this->purchase->info_purchase->contact_number ?? 'No determinado' ?></span>

                <a href="#">Ir al chat</a>

                <p>Total: $<?= $this->purchase->total?></p>
            </div>
        </article>
        <?php
        return ob_get_clean();
    }

}