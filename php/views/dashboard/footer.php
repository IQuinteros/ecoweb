<?php
require_once __DIR__.('/../base_view.php');

class FooterView extends BaseView{

    public function __construct(){
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <footer class="footer">
            <p>Somos ECOmercio, tu app de compras amigables</p>
        </footer>
        <?php
        return ob_get_clean();
    }

}
