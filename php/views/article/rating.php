<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../utils/article_util.php');

class RatingView extends BaseView{

    private float $avgRating;

    public function __construct(float $avgRating){
        $this->avgRating = $avgRating;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="stars">
            <?= $this->getStar($this->avgRating, 0, 1) ?>
            <?= $this->getStar($this->avgRating, 1, 2) ?>
            <?= $this->getStar($this->avgRating, 2, 3) ?>
            <?= $this->getStar($this->avgRating, 3, 4) ?>
            <?= $this->getStar($this->avgRating, 4, 5) ?>
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
