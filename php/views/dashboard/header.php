<?php
require_once __DIR__.('/../base_view.php');

class HeaderView extends BaseView{

    private string $title;
    private ?string $leftBottom;
    private ?string $rightTop;
    private ?string $rightBottom;

    public function __construct(
        string $title, 
        string $leftBottom = null, 
        string $rightTop = null, 
        string $rightBottom = null
    ){
        $this->title = $title;
        $this->leftBottom = $leftBottom;
        $this->rightTop = $rightTop;
        $this->rightBottom = $rightBottom;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <header class="main__header">
            <?php if($this->title != null)?><h1 class="header__title"><?=$this->title?></h1>
            <?php if($this->rightTop != null)?><h2 class="header__subtitle header__subtitle--topright"><?=$this->rightTop?></h2>
            <?php if($this->rightBottom != null)?><h2 class="header__subtitle header__subtitle--bottomright"><?=$this->rightBottom?></h2>
            <?php if($this->leftBottom != null)?><h2 class="header__subtitle header__subtitle--bottomleft"><?=$this->leftBottom?></h2>
            
        </header>
        <?php
        return ob_get_clean();
    }

}
    
?>