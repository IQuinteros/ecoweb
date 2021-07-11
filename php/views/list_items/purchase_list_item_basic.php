<?php
require_once __DIR__.('/../base_view.php');

class PurchaseListItemBasic extends BaseView{

    private int $articlesAmount;
    private int $total;
    private string $creationDate;

    public function __construct(int $articlesAmount, int $total, string $creationDate){
        $this->articlesAmount = $articlesAmount;
        $this->total = $total;
        $this->creationDate = $creationDate;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();

        ?>
        <button onclick="window.open('purchases.php', '_self')" class="card btn purchase <?php //btn--red ?>">
            <h1 class="purchase__quantity"><?= $this->articlesAmount ?> artículos</h1>
            <p class="purchase__status">$<?= $this->total ?></p>
            <p class="purchase__date"><?= $this->creationDate ?></p>
        </button>
        <?php
        return ob_get_clean();
    }

}
