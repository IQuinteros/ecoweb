<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');
require_once __DIR__.('/../../views/article/rating.php');

class OpinionListItemView extends BaseView{

    private Opinion_model $opinion;
    private Article_model $article;

    public function __construct(Opinion_model $opinion, Article_model $article){
        $this->opinion = $opinion;
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
                    <a class="list-item__content__title" href="editarticle.php?id=<?= $this->article->id ?>"><?= $this->article->title ?></a>
                    <p><?= $this->opinion->creation_date ?></p>
                </div>
                <div class="list-item__content__row">
                    <p class="w300"><?= $this->opinion->profile_name ?></p>
                    <?= new RatingView($this->opinion->rating)?>
                </div>
                <div class="list-item__content__row">
                    <p><?= $this->opinion->title ?></p>
                    <?php if(!empty($this->opinion->content)){?><a href="#">Ver comentario</a><?php } ?>
                </div>
            </div>
        </button>
        <?php
        return ob_get_clean();
    }

}
