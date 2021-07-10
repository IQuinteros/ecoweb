<?php
require_once __DIR__.('/../base_view.php');

class TextInputView extends BaseView{

    private string $placeholder;
    private string $name;
    private string $title;
    private string $id;
    private string $value;
    private bool $isTextArea;
    private bool $required;

    public function __construct(
        string $title,
        string $name,
        string $id,
        string $placeholder = '',
        string $value = '',
        bool $isTextArea = false,
        bool $required = true
    ){
        $this->placeholder = $placeholder;
        $this->title = $title ?? '';
        $this->name = $name ?? '';
        $this->id = $id ?? '';
        $this->value = $value ?? '';
        $this->isTextArea = $isTextArea ?? false;
        $this->required = $required ?? true;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="input-container">
            <label class="input-label">
                <?= $this->title ?>
                <<?= $this->isTextArea? 'textarea' : 'input'?> class="input" <?= !$this->isTextArea? 'type="text"' : ''?> id="<?= $this->id ?>" name="<?= $this->name ?>" placeholder="<?= $this->placeholder ?>" value="<?= $this->value ?>" <?= $this->required? 'required' : ''?>><?= $this->isTextArea? '</textarea>' : ''?>
            </label>
        </div>
        <?php
        return ob_get_clean();
    }

}
