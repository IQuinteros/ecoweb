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
        <label id="<?= $this->id ?>label" class="btn picker">
            <span class="picker__icon material-icons material-icons-outlined">file_upload</span>
            <span id="<?= $this->id ?>text" class="picker__text">Subir nueva imagen</span>
            <input class="input--file" type="file" name="<?= $this->name ?>" id="<?= $this->id ?>"/>
        </label>

        <script>
            let fileInput<?= $this->id ?> = document.getElementById('<?= $this->id ?>');
            let fileInputText<?= $this->id ?> = document.getElementById('<?= $this->id ?>text');


            fileInput<?= $this->id ?>.addEventListener('change', function() {
                fileInputText<?= $this->id ?>.innerHTML = 'Se subirá el archivo: <b>' + fileInput<?= $this->id ?>.value.split('\\').pop() + '</b><br>Al guardar cambios, podrá volver a subir una nueva imagen.';
            });
        </script>
        <?php
        return ob_get_clean();
    }

}
