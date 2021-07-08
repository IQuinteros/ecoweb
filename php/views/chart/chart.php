<?php
require_once __DIR__.('/../base_view.php');

class ChartView extends BaseView{

    private string $id;
    private array $labels;
    private array $values;
    private string $title;

    public function __construct(string $title, string $id = "myChart", array $labels = [], array $values = []){
        $this->id = $id;
        $this->labels = $labels;
        $this->values = $values;
        $this->title = $title;
        parent::__construct();
    }

    protected function htmlContent()
    {  
        ob_start();
        ?>
        <canvas class="chart" id="<?= $this->id ?>"></canvas>

        <script>
        const labels<?= $this->id ?> = [
            <?php foreach($this->labels as $label){ ?>
                '<?= $label ?>',
            <?php } ?>
        ];
        const data<?= $this->id ?> = {
            labels: labels<?= $this->id ?>,
            datasets: [{
            label: '<?= $this->title ?>',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
                <?php foreach($this->values as $value){ ?>
                    <?= $value ?>,
                <?php } ?>
            ],
            }]
        };

        const config<?= $this->id ?> = {
            type: 'line',
            data: data<?= $this->id ?>,
            options: {
                responsive: true,
                maintainAspectRatio: true
            }
        };

        let chart<?= $this->id ?> = new Chart(
            document.getElementById('<?= $this->id ?>'),
            config<?= $this->id ?>
        );
        </script>

        <?php
        return ob_get_clean();
    }

}
