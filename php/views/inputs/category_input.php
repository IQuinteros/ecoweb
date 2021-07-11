<?php
require_once __DIR__.('/../base_view.php');

class CategoryInputView extends BaseView{

    private string $name;
    private string $title;
    private string $id;
    private int $value;
    private bool $required;

    public function __construct(
        int $value = 0,
        string $title = 'Categoría',
        string $name = 'category',
        string $id = 'category',
        bool $required = true
    ){
        $this->title = $title ?? '';
        $this->name = $name ?? '';
        $this->id = $id ?? '';
        $this->value = $value ?? 0;
        $this->required = $required ?? true;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="input-container">
            <label class="input-label">
                <?= $this->title?>
                <select class="input" name="<?= $this->name?>" id="<?= $this->id?>" <?= $this->required? 'required' : ''?>>
                    <option value="8" <?= $this->value == 8? 'selected' : '' ?>>Hogar</option>
                    <option value="7" <?= $this->value == 7? 'selected' : '' ?>>Cuidado personal</option>
                    <option value="6" <?= $this->value == 6? 'selected' : '' ?>>Alimentos</option>
                    <option value="5" <?= $this->value == 5? 'selected' : '' ?>>Vestimenta</option>
                </select>
            </label>
        </div>
        <?php
        return ob_get_clean();
    }

}
