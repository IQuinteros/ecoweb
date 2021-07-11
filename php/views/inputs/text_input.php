<?php
require_once __DIR__.('/../base_view.php');

class TextInputView extends BaseView{

    private string $placeholder;
    private string $name;
    private string $title;
    private string $id;
    private string $value;
    private string $type;
    private bool $isTextArea;
    private bool $required;

    public function __construct(
        string $title,
        string $name,
        string $id,
        string $placeholder = '',
        string $value = '',
        bool $isTextArea = false,
        bool $required = true,
        string $type = 'text'
    ){
        $this->placeholder = htmlspecialchars($placeholder);
        $this->title = htmlspecialchars($title ?? '');
        $this->name = htmlspecialchars($name ?? '');
        $this->id = htmlspecialchars($id ?? '');
        $this->value = htmlspecialchars($value ?? '');
        $this->isTextArea = htmlspecialchars($isTextArea ?? false);
        $this->required = htmlspecialchars($required ?? true);
        $this->type = htmlspecialchars($type ?? 'text');
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        ?>
        <div class="input-container">
            <label class="input-label">
                <?= $this->title ?>
                <<?= $this->isTextArea? 'textarea' : 'input'?> class="input" <?= !$this->isTextArea? 'type="'.$this->type.'"' : ''?> id="<?= $this->id ?>" name="<?= $this->name ?>" placeholder="<?= $this->placeholder ?>" value="<?= $this->value ?>" <?= $this->required? 'required' : ''?>><?= $this->isTextArea? $this->value.'</textarea>' : ''?>
            </label>
        </div>
        <?php
        return ob_get_clean();
    }

}
