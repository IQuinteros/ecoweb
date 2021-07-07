<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');

class ArticleListItemView extends BaseView{

    private Article_model $article;

    public function __construct(Article_model $article){
        $this->article = $article;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        $ecoIndicator = new ArticleEcoIndicator($this->article);
        ?>
        <button class="list-item">
            <img class="list-item__img" src="<?= $this->article->photos[0]->photo ?? '' ?>" alt="image">
            <div class="list-item__content">
                <div class="list-item__content__row">
                    <a class="list-item__content__title" href="editarticle.php"><?= $this->article->title ?></a>
                    <p>Publicado</p>
                </div>
                <div class="list-item__content__row">
                    <p class="w300">$<?= $this->article->price ?></p>
                    <div class="ecoindicator ecoindicator--linear">
                        <?php if($ecoIndicator->hasReuseTips){?><div class="ecoindicator__circle ecoindicator__circle--yellow"></div><?php }?>
                        <?php if($ecoIndicator->hasRecycledMaterials){?><div class="ecoindicator__circle ecoindicator__circle--blue"></div><?php }?>
                        <?php if($ecoIndicator->isRecyclable){?><div class="ecoindicator__circle ecoindicator__circle--green"></div><?php }?>                        
                    </div>
                </div>
                <div class="list-item__content__row">
                    <p>2531 visualizaciones</p>
                    <div class="stars">
                        <span class="material-icons star--active">star</span>
                        <span class="material-icons star--active">star</span>
                        <span class="material-icons star--active">star</span>
                        <span class="material-icons star--active">star</span>
                        <span class="material-icons star--inactive">star</span>
                    </div>
                </div>
            </div>
        </button>
        <?php
        return ob_get_clean();
    }

}
