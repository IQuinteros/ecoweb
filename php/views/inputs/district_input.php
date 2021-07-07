<?php
require_once __DIR__.('/../base_view.php');
require_once __DIR__.('/../../../api/models/store_model.php');
require_once __DIR__.('/../../utils/auth_util.php');
require_once __DIR__.('/../../../api/query/district.php');

class DistrictInputView extends BaseView{

    private ?District $districtConnection;
    private int $selectedDistrict;

    private string $name;
    private string $id;

    public function __construct(
        int $selected = 0,
        string $name = 'district',
        string $id = 'district'
    ){
        $this->districtConnection = new District();
        $this->selectedDistrict = $selected;
        $this->name = $name;
        $this->id = $id;
        parent::__construct();
    }


    protected function htmlContent()
    {  
        ob_start();
        $districts = $this->districtConnection->select(null);
        ?>
        <div class="input-container">
            <label class="input-label">
                Comuna
                <select class="input" name="<?= $this->name ?>" id="<?= $this->id ?>">
                    <?php foreach($districts as $value){ ?>
                    <option value="<?= $value->id ?>" <?= $this->selectedDistrict == $value->id? 'selected' : ''?>><?= $value->name?></option>
                    <?php } ?>
                </select>
            </label>
        </div>
        <?php
        return ob_get_clean();
    }

}
