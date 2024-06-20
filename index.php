<?php
include("sess_check.php");
include_once("function.php");
setlocale(LC_TIME, 'id_ID');
$currentYear = date("Y");

$sql_bulan = "SELECT name_month, nama_bulan FROM bulan";
$result_bulan = $conn->query($sql_bulan);
$getMonth = isset($_GET['selectMonth']) ? $_GET['selectMonth'] : '';
$getYear = isset($_GET['selectYear']) ? $_GET['selectYear'] : '';

// Fetch data for status
$sql_all = "";
if (!empty($getYear)) {
    $sql_all = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan != 'Declined' and tahun_pengajuan = '$getYear'";
} else {
    $sql_all = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan != 'Declined' and tahun_pengajuan = '$currentYear'";
}

$ress_all = mysqli_query($conn, $sql_all);
if ($ress_all) {
    $all = mysqli_num_rows($ress_all);
} else {
    die("Query failed: " . mysqli_error($conn));
}

$sql_selesai = "";

if (!empty($getMonth)) {
    $sql_selesai = "SELECT id_selesai FROM selesai JOIN bulan ON bulan_selesai = name_month WHERE tahun_selesai = '$getYear' AND name_month = '$getMonth'";
} else {
    $sql_selesai = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Selesai'";
}

$ress_selesai = mysqli_query($conn, $sql_selesai);
if ($ress_selesai) {
    $selesai = mysqli_num_rows($ress_selesai);
} else {
    die("Query failed: " . mysqli_error($conn));
}

$sql_app = "";
if (!empty($getYear)) {
    $sql_app = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Approved' and tahun_pengajuan = '$getYear'";
} else {
    $sql_app = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Approved' and tahun_pengajuan = '$currentYear'";
}
$ress_app = mysqli_query($conn, $sql_app);
if ($ress_app) {
    $app = mysqli_num_rows($ress_app);
} else {
    die("Query failed: " . mysqli_error($conn));
}
$sql_dec = "";
if (!empty($getYear)) {
    $sql_dec = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Declined' and tahun_pengajuan = '$getYear'";
} else {
    $sql_dec = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Declined' and tahun_pengajuan = '$currentYear'";
}
$ress_dec = mysqli_query($conn, $sql_dec);
if ($ress_dec) {
    $dec = mysqli_num_rows($ress_dec);
} else {
    die("Query failed: " . mysqli_error($conn));
}

$sql_wait = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Awaiting'";
if (!empty($getYear)) {
    $sql_wait = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Awaiting' and tahun_pengajuan = '$getYear'";
} else {
    $sql_wait = "SELECT id_pengajuan FROM pengajuan WHERE status_pengajuan = 'Awaiting' and tahun_pengajuan = '$currentYear'";
}
$ress_wait = mysqli_query($conn, $sql_wait);
if ($ress_wait) {
    $wait = mysqli_num_rows($ress_wait);
} else {
    die("Query failed: " . mysqli_error($conn));
}

$percent_app = ($all > 0) ? ($app / $all) * 100 : 0;
$percent_wait = ($all > 0) ? ($wait / $all) * 100 : 0;
$percent_sel = ($all > 0) ? ($selesai / $all) * 100 : 0;

// Data for bar chart
$sql_officers = "";
if (!empty($getYear)) {
    $sql_officers = "SELECT petugas_pemetaan, COUNT(id_pengajuan) as count FROM pengajuan WHERE status_pengajuan = 'Approved' and tahun_pengajuan = '$getYear' GROUP BY petugas_pemetaan";
} else {
    $sql_officers = "SELECT petugas_pemetaan, COUNT(id_pengajuan) as count FROM pengajuan WHERE status_pengajuan = 'Approved' and tahun_pengajuan = '$currentYear' GROUP BY petugas_pemetaan";
}
$ress_officers = mysqli_query($conn, $sql_officers);
$officers_data = [];
while ($row = mysqli_fetch_assoc($ress_officers)) {
    $officers_data[] = $row;
}

// deskripsi halaman
$pagedesc = "Beranda";
include("layout_top.php");
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<div id="page-wrapper">
    <div class="container-fluid" style="margin-top: 5px">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div><!-- /.col-lg-12 -->
        </div>
        <form method="GET" action="index.php">
            <div class="form-group">
                <label for="selectYear">Pilih Bulan:</label>
                <select class="form-control" id="selectYear" name="selectYear" required>
                    <option value="">Pilih Tahun</option>
                    <?php
                        $start_year = 2024;
                        $end_year = date('Y');
                        $getYear = (isset($_GET['selectYear']) && is_numeric($_GET['selectYear'])) ? $_GET['selectYear'] : '';
                            for ($year = $start_year; $year <= $end_year; $year++) {
                                $selected = ($year == $getYear) ? 'selected="selected"' : '';
                                echo "<option value=\"$year\" $selected>$year</option>";
                            }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="selectMonth">Pilih Bulan:</label>
                <select class="form-control" id="selectMonth" name="selectMonth" required>
                    <option value="">Pilih Bulan</option>
                    <?php
                    // Menyimpan hasil query ke dalam array
                    while ($row_bulan = $result_bulan->fetch_assoc()) {
                        $selected = ($row_bulan['name_month'] == $getMonth) ? 'selected="selected"' : '';
                        echo "<option value='" . $row_bulan['name_month'] . "' $selected>" . $row_bulan['nama_bulan'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        <div class="row">
            <div class="col-lg-6">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="officerChart"></canvas>
            </div>
        </div>
        <div class="row" style="margin-top:10px">
            <div class="col-lg-6">
                <div class="text-center">
                    <p class="caption">Keterangan :</p>
                    <p class="status">Masuk: <?php echo $wait; ?> Berkas</p>
                    <p class="status">Diterima: <?php echo $app; ?> Berkas</p>
                    <p class="status">Selesai: <?php echo $selesai; ?> Berkas</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <p class="caption">Keterangan :</p>
                    <?php foreach ($officers_data as $officer) { ?>
                    <p class="status"><?php echo $officer["petugas_pemetaan"]; ?>: <?php echo $officer["count"]; ?>
                        Berkas Dalam Proses</p>
                    <?php } ?>
                </div>
            </div>

        </div>

        <!-- Panels for data summary -->
        <div class="row" style="margin-top: 10px">
            <!-- Panel for Awaiting -->
            <div class="col-lg-6 col-md-6">
                <a href="app_wait.php">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="glyphicon glyphicon-time fa-3x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $wait; ?></div>
                                            <div>
                                                <h4>Permohonan Masuk<h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Rincian</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Panel for Approved -->
            <div class="col-lg-6 col-md-6">
                <a href="app.php">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="glyphicon glyphicon-ok-circle fa-3x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $app; ?></div>
                                            <div>
                                                <h4>Diterima</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Rincian</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Panel for Declined -->
            <div class="col-lg-6 col-md-6">
                <a href="app_decline.php">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="glyphicon glyphicon-remove-circle fa-3x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $dec; ?></div>
                                            <div>
                                                <h4>Ditolak<h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Rincian</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Panel for All -->
            <div class="col-lg-6 col-md-6">
                <a href="app_all.php">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="glyphicon glyphicon-stats fa-3x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $selesai; ?></div>
                                            <div>
                                                <h4>Selesai</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <span class="pull-left">Lihat Rincian</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Script for chart rendering -->
        <script>
        var ctxStatus = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Diterima', 'Masuk'],
                datasets: [{
                    label: 'Status',
                    data: [<?php echo $percent_sel; ?>, <?php echo $percent_app; ?>,
                        <?php echo $percent_wait; ?>
                    ],
                    backgroundColor: ['#28a745', '#007bff', '#ffc107'],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            return value.toFixed(2) + '%';
                        },
                        color: '#ffffff',
                        textShadowColor: '#000000',
                        textShadowBlur: 4
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            }
        });

        // Bar Chart
        var ctxOfficer = document.getElementById('officerChart').getContext('2d');
        var officerLabels = [];
        var officerCounts = [];
        <?php foreach ($officers_data as $officer) { ?>
        officerLabels.push('<?php echo $officer["petugas_pemetaan"]; ?>');
        officerCounts.push(<?php echo $officer["count"]; ?>);
        <?php } ?>
        var officerChart = new Chart(ctxOfficer, {
            type: 'bar',
            data: {
                labels: officerLabels,
                datasets: [{
                    label: 'Berkas Dalam Proses',
                    data: officerCounts,
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1,
                    hoverBackgroundColor: '#0056b3',
                    hoverBorderColor: '#003f7f',
                    barPercentage: 0.5,
                    barThickness: 20,
                    maxBarThickness: 25,
                    minBarLength: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#ffffff',
                        formatter: Math.round,
                        textShadowColor: '#000000',
                        textShadowBlur: 4
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            stepSize: 1
                        }
                    }
                }
            }
        });
        </script>
    </div>
</div>

<?php
include("layout_bottom.php");
?>