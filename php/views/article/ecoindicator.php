<?php
require_once __DIR__.('/../base_view.php');

class EcoIndicatorView extends BaseView{

    private ArticleEcoIndicator $ecoIndicator;
    private bool $linear = false;

    public function __construct(ArticleEcoIndicator $ecoIndicator, bool $linear = false){
        $this->ecoIndicator = $ecoIndicator;
        $this->linear = $linear;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="ecoindicator <?= $this->linear? 'ecoindicator--linear' : ''?>">
            <?php if($this->ecoIndicator->hasReuseTips){?><div class="ecoindicator__circle ecoindicator__circle--yellow"></div><?php }?>
            <?php if($this->ecoIndicator->hasRecycledMaterials){?><div class="ecoindicator__circle ecoindicator__circle--blue"></div><?php }?>
            <?php if($this->ecoIndicator->isRecyclable){?><div class="ecoindicator__circle ecoindicator__circle--green"></div><?php }?>                        
        </div>
        <?php
        return ob_get_clean();
    }

}
