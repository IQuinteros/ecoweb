<?php
require_once __DIR__.('/../base_view.php');

class CheckGroupInput extends BaseView{

    private string $name;

    public function __construct(
        string $name
    ){
        $this->name = $name ?? '';
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="check-group">
            <label class="input-label">
                <input name="<?= $this->name ?>" class="checkbox" type="radio" value="fully">
                <span class="material-icons material-icons-outlined checkmark">done</span>
                <span class="input-label__text">Totalmente</span> 
            </label>
            <label class="input-label">
                <input name="<?= $this->name ?>" class="checkbox" type="radio" value="partial">
                <span class="material-icons material-icons-outlined checkmark">done</span>
                <span class="input-label__text">Parcialmente</span> 
            </label>
            <label class="input-label">
                <input name="<?= $this->name ?>" class="checkbox" type="radio" value="">
                <span class="material-icons material-icons-outlined checkmark">done</span>
                <span class="input-label__text">Ninguno</span> 
            </label>
        </div>
        <?php
        return ob_get_clean();
    }

}
