<?php
require_once __DIR__.('/../base_view.php');

class ImageInputView extends BaseView{

    private string $name;
    private string $id;

    public function __construct(
        string $name = 'newImg',
        string $id = 'newImg'
    ){
        $this->name = $name ?? '';
        $this->id = $id ?? '';
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <label class="btn picker">
            <span class="picker__icon material-icons material-icons-outlined">file_upload</span>
            <span class="picker__text">Subir nueva imagen</span>
            <input class="input--file" type="file" name="<?= $this->name ?>" id="<?= $this->id ?>"/>
        </label>
        <?php
        return ob_get_clean();
    }

}
