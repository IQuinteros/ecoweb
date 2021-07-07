<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');
require_once __DIR__.('/../../views/article/rating.php');
require_once __DIR__.('/../../views/article/ecoindicator.php');

class ArticleListItemView extends BaseView{

    private Article_model $article;

    public function __construct(Article_model $article){
        $this->article = $article;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <button class="list-item">
            <img class="list-item__img" src="<?= $this->article->photos[0]->photo ?? 'assets/img/no-image-bg.png' ?>" alt="image">
            <div class="list-item__content">
                <div class="list-item__content__row">
                    <a class="list-item__content__title" href="editarticle.php"><?= $this->article->title ?></a>
                    <p><?= $this->article->enabled? 'Publicado' : 'Desactivado' ?></p>
                </div>
                <div class="list-item__content__row">
                    <p class="w300">$<?= $this->article->price ?></p>
                    <?= new EcoIndicatorView(new ArticleEcoIndicator($this->article), true) ?>
                </div>
                <div class="list-item__content__row">
                    <p>2531 visualizaciones</p>
                    <?= new RatingView((new ArticleRating($this->article))->getAvgRating()) ?>
                </div>
            </div>
        </button>
        <?php
        return ob_get_clean();
    }

}
