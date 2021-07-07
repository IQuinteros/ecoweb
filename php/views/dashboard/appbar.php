<?php

require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../utils/enum.php');
require_once __DIR__.('/../../../api/models/store_model.php');
require_once __DIR__.('/../../utils/auth_util.php');

final class AppBarSelected extends Enum {
    public const HOME = 0;
    public const PURCHASES = 1;
    public const CHATS = 2;
    public const QUESTIONS = 3;
    public const RATING = 4;
    public const INVENTORY = 5;
    public const REPORTS = 6;
    public const PROFILE = 7;
    
    public static function emptyEnum(Enum $enum = null){
        if(Enum::isValid($enum)) return $enum;
        return new AppBarSelected(Enum::NONE);
    }
}

class AppBarView extends BaseView{

    private AppBarSelected $selected;
    private ?Store_model $store;

    public function __construct(AppBarSelected $selected = null)
    {
        $this->selected = AppBarSelected::emptyEnum($selected);
        $this->store = AuthUtil::getStoreSession();

        parent::__construct();
    }

    private function getSelectedClass($value) : string {
        return $this->selected->isEqual($value)? 'nav__list__item--selected' : '';
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <aside id="appbar" class="leftbar">
            <div class="leftbar__appbar">
                <a href="#" class="leftbar__menu" onclick="toggleMenu()">
                    <span class="material-icons material-icons-outlined">menu</span>
                    <span class="nav__list__item__text">Menu</span>
                </a>
                <img class="leftbar__img" src="<?=$this->store->photo_url ?? '' ?>" alt="">
            </div>
            <h1 class="leftbar__title"><?=$this->store->public_name ?? 'Indeterminado' ?></h1>
            <p class="leftbar__date"><?//Lunes 15 de Abril de 2021?><?= date("D d M Y")?></p>

            <nav class="leftbar__nav nav">
                <ul class="nav__list">
                    <a href="dashboard.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::HOME)?>">
                        <span class="material-icons material-icons-outlined">home</span>
                        <span class="nav__list__item__text">Home</span>
                    </a>
                    <a href="purchases.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::PURCHASES)?>">
                        <span class="material-icons material-icons-outlined">shopping_cart</span>
                        <span class="nav__list__item__text">Pedidos</span>
                    </a>
                    <a href="chat.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::CHATS)?>">
                        <span class="material-icons material-icons-outlined">chat_bubble_outline</span>
                        <span class="nav__list__item__text">Chats</span>
                    </a>
                    <a href="questions.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::QUESTIONS)?>">
                        <span class="material-icons material-icons-outlined">live_help</span>
                        <span class="nav__list__item__text">Preguntas</span>
                    </a>
                    <a href="rating.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::RATING)?>">
                        <span class="material-icons material-icons-outlined">star_outline</span>
                        <span class="nav__list__item__text">Valoraciones</span>
                    </a>
                    <a href="inventory.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::INVENTORY)?>">
                        <span class="material-icons material-icons-outlined">inventory_2</span>
                        <span class="nav__list__item__text">Inventario</span>
                    </a>
                    <a href="reports.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::REPORTS)?>">
                        <span class="material-icons material-icons-outlined">timeline</span>
                        <span class="nav__list__item__text">Reportes</span>
                    </a>
                    <a href="profile.php" class="nav__list__item <?=$this->getSelectedClass(AppBarSelected::PROFILE)?>">
                        <span class="material-icons material-icons-outlined">admin_panel_settings</span>
                        <span class="nav__list__item__text">Perfil</span>
                    </a>
                    <a href="logout.php" class="nav__list__item">
                        <span class="material-icons material-icons-outlined">logout</span>
                        <span class="nav__list__item__text">Cerrar sesión</span>
                    </a>
                </ul>
            </nav>
        </aside>
        <?php
        return ob_get_clean();
    }

}
    