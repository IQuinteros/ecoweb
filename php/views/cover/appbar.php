<?php
require_once __DIR__.('/../base_view.php');


class AppBarView extends BaseView{

    public function __construct(){
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <header class="appbar">
            <a class="appbar__title" href="index.php">ECOmercio</a>
            <nav class="appbar__nav">
                <ul>
                    <li><a href="#">Descarga Android</a></li>
                    <li><a href="login.php">Entrar como vendedor</a></li>
                </ul>
            </nav>
            <button onclick="window.open('login.php', '_self')" class="appbar__profile">
                <span class="material-icons material-icons-outlined">account_circle</span>
            </button>
        </header>
        <?php
        return ob_get_clean();
    }

}
