<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');
require_once __DIR__.('/../../utils/article_util.php');
require_once __DIR__.('/../../views/article/rating.php');
require_once __DIR__.('/../../views/article/ecoindicator.php');

class QuestionListItemView extends BaseView{

    private Question_model $question;
    private Article_model $article;

    public function __construct(Question_model $question, Article_model $article){
        $this->question = $question;
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
                    <a class="list-item__content__title" href="editarticle.php?id=<?= $this->article->id ?>"><?= $this->question->article_name ?></a>
                    <p><?= $this->question->creation_date ?></p>
                </div>
                <div class="list-item__content__row">
                    <p class="w300"><?= $this->question->profile_name ?></p>
                    <p class="w300"><?= $this->question->answer != null? 'Ya respondido' : '' ?></p>
                </div>
                <div class="list-item__content__row">
                    <p><?= $this->question->question ?></p>
                    <a href="#" onclick="
                        <?php if($this->question->answer == null) {?>
                            inputQuestion<?= $this->question->id ?>();
                        <?php } else { ?>
                            displayAlert('Ver pregunta', '<?= $this->question->answer->answer ?>', 'Volver')
                        <?php } ?>
                    "><?= $this->question->answer != null? 'Ver respuesta' : 'Responder' ?></a>
                </div>
            </div>
        </button>
        <script>
            let inputQuestion<?= $this->question->id ?> = function(){
                inputAlert(
                    'Responder pregunta', 
                    '<?= $this->question->question?>', 
                    'Responder',
                    (val) => {
                        val = val.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;");
                        window.open(`questions.php?id=<?= $this->question->id ?>&response=${val}`, '_self')
                    }
                )
            }
        </script>
        <?php
        return ob_get_clean();
    }

}
