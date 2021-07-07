<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../utils/article_util.php');

class RatingView extends BaseView{

    private ArticleRating $articleRating;

    public function __construct(ArticleRating $articleRating){
        $this->articleRating = $articleRating;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        $avg = $this->articleRating->getAvgRating();
        ?>
        <div class="stars">
            <?= $this->getStar($avg, 0, 1) ?>
            <?= $this->getStar($avg, 1, 2) ?>
            <?= $this->getStar($avg, 2, 3) ?>
            <?= $this->getStar($avg, 3, 4) ?>
            <?= $this->getStar($avg, 4, 5) ?>
        </div>
        <?php
        return ob_get_clean();
    }

    protected function getStar(int $value, int $minimum = 0, int $maximum = 1){
        ob_start();
        ?>
        <span class="material-icons <?= $value > $minimum? 'star--active' : 'star--inactive'?>"><?= $value == $maximum || $value > $maximum? 'star' : ($value < $maximum && $value > $minimum? 'star_half' : 'star_outline')?></span>
        <?php
        return ob_get_clean();
    }

}
