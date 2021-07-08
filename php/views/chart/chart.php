<?php
require_once __DIR__.('/../base_view.php');

class ChartView extends BaseView{

    private string $id;
    private array $labels;
    private string $title;

    public function __construct(string $title, array $labels = [], string $id = "myChart"){
        $this->id = $id;
        $this->labels = $labels;
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
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];
        const data<?= $this->id ?> = {
            labels: labels<?= $this->id ?>,
            datasets: [{
            label: '<?= $this->title ?>',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };

        const config<?= $this->id ?> = {
            type: 'line',
            data<?= $this->id ?>,
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
