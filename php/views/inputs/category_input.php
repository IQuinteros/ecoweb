<?php
require_once __DIR__.('/../base_view.php');

class CategoryInputView extends BaseView{

    private string $name;
    private string $title;
    private string $id;
    private int $value;

    public function __construct(
        int $value = 0,
        string $title = 'Categoría',
        string $name = 'category',
        string $id = 'category'
    ){
        $this->title = $title ?? '';
        $this->name = $name ?? '';
        $this->id = $id ?? '';
        $this->value = $value ?? 0;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="input-container">
            <label class="input-label">
                <?= $this->title?>
                <select class="input" name="<?= $this->name?>" id="<?= $this->id?>">
                    <option value="2" <?= $this->value == 2? 'selected' : '' ?>>Hogar</option>
                    <option value="1" <?= $this->value == 1? 'selected' : '' ?>>Cuidado personal</option>
                    <option value="3" <?= $this->value == 3? 'selected' : '' ?>>Alimentos</option>
                    <option value="4" <?= $this->value == 4? 'selected' : '' ?>>Vestimenta</option>
                </select>
            </label>
        </div>
        <?php
        return ob_get_clean();
    }

}
