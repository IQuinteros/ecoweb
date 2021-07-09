<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/ecoindicator.php');
require_once __DIR__.('/../../utils/article_util.php');

class ArticleCardView extends BaseView{

    private Article_model $article;

    public function __construct(Article_model $article){
        $this->article = $article;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <button class="card btn article" onclick="window.open('editarticle.php?id=<?= $this->article->id ?>', '_self')">
            <img class="article__img" src="<?= $this->article->photos[0]->photo ?? 'assets/img/no-image-bg.png'?>" alt="image">
            <div class="article__content">
                <h1 class="article__content__title"><?= $this->article->title?></h1>
                <h1 class="article__content__price">$<?= $this->article->price?></h1>
                <?= new EcoIndicatorView(new ArticleEcoIndicator($this->article))?>
            </div>
        </button>
        <?php
        return ob_get_clean();
    }

}
