<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/article_model.php');

class EditPhotoView extends BaseView{

    private ?string $photo;
    private ?int $photoId;

    public function __construct(string $photo = null, int $photoId = null){
        $this->photo = $photo;
        $this->photoId = $photoId;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <button type="submit" name="deleteimg" value="<?= $this->photoId ?? 0 ?>" class="btn photo">
            <img class="photo__img" src="<?= $this->photo ?? 'assets/img/no-image-bg.png' ?>" alt="">
            <div class="photo__delete">
                <span class="photo__delete__icon material-icons material-icons-outlined">delete</span>
                <span class="photo__delete__text">Eliminar imagen</span>
            </div>
        </button>
        <?php
        return ob_get_clean();
    }

}
