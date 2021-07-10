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
            <div class="main__container">
                <h1>¿Quieres vender productos amigables en nuestra plataforma?</h1>
                <div class="footer__content">
                    <ul>
                        <li>
                            <span class="footer__content__icon main__card__icon material-icons material-icons-outlined">eco</span>
                            <span>Obtén estadística de tus clientes</span>
                        </li>
                        <li>
                            <span class="footer__content__icon main__card__icon material-icons material-icons-outlined">eco</span>
                            <span>Revisa cuánto estás vendiendo</span>
                        </li>
                        <li>
                            <span class="footer__content__icon main__card__icon material-icons material-icons-outlined">eco</span>
                            <span>Publica tus artículos rápidamente</span>
                        </li>
                        <li>
                            <span class="footer__content__icon main__card__icon material-icons material-icons-outlined">eco</span>
                            <span>Interactúa con tus clientes</span>
                        </li>
                    </ul>
                    <button onclick="window.open('signup.php', '_self')" class="btn btn--footer">Envía tu solicitud aquí</button>
                </div>
                <hr class="divider">
                <h3 class="footer__text">Somos ECOmercio, tu app de compras amigables</h3>
            </div>
        </footer>
        <?php
        return ob_get_clean();
    }

}
