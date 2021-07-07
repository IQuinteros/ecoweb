<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');
require_once __DIR__.('/../../views/article/rating.php');
require_once __DIR__.('/../../views/article/ecoindicator.php');

class QuestionListItemView extends BaseView{

    private Question_model $question;

    public function __construct(Question_model $question){
        $this->question = $question;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <button class="list-item">
            <img class="list-item__img" src="https://source.unsplash.com/random/1" alt="image">
            <div class="list-item__content">
                <div class="list-item__content__row">
                    <a class="list-item__content__title" href="#"><?= $this->question->article_name ?></a>
                    <p><?= $this->question->creation_date ?></p>
                </div>
                <div class="list-item__content__row">
                    <p class="w300"><?= $this->question->profile_name ?></p>
                    <p class="w300"><?= $this->question->answer != null? 'Ya respondido' : '' ?></p>
                </div>
                <div class="list-item__content__row">
                    <p><?= $this->question->question ?></p>
                    <a href="#"><?= $this->question->answer != null? 'Ver respuesta' : 'Responder' ?></a>
                </div>
            </div>
        </button>
        <?php
        return ob_get_clean();
    }

}
