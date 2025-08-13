<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<script src="<?=base_url('public/')?>assets/js/chart.js"></script>

<div class="row">
<div class="col-lg-9">
    <div class="card">
        <div class="card-header bg-primary pb-1">
            <h5 class="card-title fw-semibold text-white"><i class="ti ti-chart-bar"></i> Overview Pelanggaran</h5>
        </div>
        <div class="card-body">
            <!-- <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              
               
            </div> -->
    
                <div class="row">
                <div class="col-lg-2">
                <select class="form-select form-select-sm" id="chartTypeSelect">
                        <option value="bar">Bar</option>
                        <option value="line">Line</option>
                        <option value="pie">Pie</option>
                        <option value="doughnut">Doughnut</option>
                    </select>
                </div>
                <div class="col-lg-3">
                <select class="form-select form-select-sm" id="periodeSelect">
                        <?php
                        if (ListOfPeriode()) {
                            foreach (ListOfPeriode() as $p) {
                               ?>
                            <option value="<?=$p['id']?>">TP.<?=$p['nm_periode']?> <?=$p['status_periode']==1 ? '(Aktif)' :null ?></option>
                               <?php
                            }
                        }
                        ?>
                    </select>
                </div>
           
                
            </div>
            
            <canvas id="chart"></canvas>
        </div>
    </div>
</div>

          <div class="col-lg-3">
            <?php
            foreach (ListOfSekolah() as $s) {
            $jml = JumlahSiswaMelanggarBySekolah($s['id']);
            // var_dump($jml);

            ?>
            <!-- <div class="col-lg-3"> -->
            <div class="card shadow-sm mb-1">
            <div class="card-header bg-warning text-white text-center">
            <h2 class="mb-0"><i class="ti ti-users text-white"></i></h2>
            </div>
            <div class="card-body p-2 text-center">
            <b><?=strtoupper($s['nm_sekolah'])?></b>
            <h5><strong><?=$jml?></strong> </h5>
            <div>Siswa Melanggar</div>
            </div>
            </div>
            <!-- </div> -->
            <?php }?>
           
          </div>
        </div>

        <script>
    $(document).ready(function() {
        var chartInstance;
        var chartType = 'bar';

        function getChartData(periode_langgar_id) {
            $.ajax({
                url: '<?=base_url('admin/pelanggaran/grafik')?>', // Ganti dengan endpoint API Anda
                method: 'GET',
                data: { periode_langgar_id: periode_langgar_id },
                success: function(response) {
                    renderChart(response);
                },
                error: function(error) {
                    console.error('Error fetching data', error);
                }
            });
        }

        function renderChart(data) {
            if (chartInstance) {
                chartInstance.destroy();
            }

            var ctx = document.getElementById('chart').getContext('2d');

            var colors = [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];

            var borderColors = [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            var backgroundColor = [];
            var borderColor = [];

            for (var i = 0; i < data.labels.length; i++) {
                backgroundColor.push(colors[i % colors.length]);
                borderColor.push(borderColors[i % borderColors.length]);
            }

            chartInstance = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Pelanggaran',
                        data: data.values,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        $('#periodeSelect').change(function() {
            var selectedPeriode = $(this).val();
            getChartData(selectedPeriode);
        });

        $('#chartTypeSelect').change(function() {
            chartType = $(this).val();
            getChartData($('#periodeSelect').val());
        });

        // Inisialisasi grafik dengan periode pertama
        getChartData($('#periodeSelect').val());
    });
</script>


<?= $this->endSection() ?>