<?php
// setting tanggal
$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulans_count = count($bulans);
// tanggal bulan dan tahun hari ini
$hari_ini = $haries[date("l")];
$bulan_ini = $bulans[date("n")];
$tanggal = date("d");
$bulan = date("m");
$tahun = date("Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= APP_TITLE ?><?php echo $pagedesc ?></title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js" type="text/javascript">
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js" type="text/javascript"></script>


    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script> -->


    <link href="libs/images/Logo_BPN-KemenATR.png" rel="icon" type="images/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="libs/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="libs/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="libs/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="dist/css/offline-font.css" rel="stylesheet">
    <link href="dist/css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <!-- <script src="libs/jquery/dist/jquery.min.js"></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .caption {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        text-align: left;
    }

    .status {
        font-size: 16px;
        color: #666;
        margin-bottom: 5px;
        text-align: left;
    }
    </style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-xs" href="<?=baseUrl();?>">
                    <img src="libs/images/Logo_BPN-KemenATR.png" alt="brand" width="32" class="float-left image-brand">
                    <div class="float-right">&nbsp;<strong>ATR/BPN Kabupaten Sragen</strong></div>
                    <div class="clear-both"></div>
                </a>
            </div><!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown dropdown-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>&nbsp;<?php echo ucfirst($sess_admname); ?>&nbsp;<i
                            class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="pengaturan.php"><i class="fa fa-gear fa-fw"></i>&nbsp;Pengaturan Akun</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a></li>
                    </ul><!-- /.dropdown-user -->
                </li><!-- /.dropdown -->
            </ul><!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <h4><strong><?= APP_TITLE ?></strong></h4>
                            <h5 class="text-muted"><i
                                    class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?>
                            </h5>
                        </li>
                        <?php
						if ($pagedesc == "Beranda") {
							echo '<li><a href="index.php" class="active"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
						} else {
							echo '<li><a href="index.php"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
						}
						if (isset($menuparent) && $menuparent == "master") {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
						?>
                        <!-- open <li> tag generated with php, see line 134-139 -->
                        <a href="#"><i class="fa fa-group fa-fw"></i>&nbsp;Master Data<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php
							if ($pagedesc == "Master Data") {
								echo '<li><a href="notaris.php" class="active">Master Data</a></li>';
							} else {
								echo '<li><a href="notaris.php">Data Notaris</a></li>';
							}
							if ($pagedesc == "Master desa") {
								echo '<li><a href="master_desa.php" class="active">Data Desa</a></li>';
							} else {
								echo '<li><a href="master_desa.php">Data Desa</a></li>';
							}
							if ($pagedesc == "Master Petugas") {
								echo '<li><a href="petugas.php" class="active">Data Petugas Pemetaan</a></li>';
							} else {
								echo '<li><a href="petugas.php">Data Petugas Pemetaan</a></li>';
							}
							?>
                        </ul><!-- /.nav-second-level -->
                        </li>
                        <?php
						if (isset($menuparent) && $menuparent == "approval") {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
						?>
                        <a href="#"><i class="fa fa-download fa-fw"></i>&nbsp;Pengajuan Plotting<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php
							if ($pagedesc == "Awaiting") {
								echo '<li><a href="app_wait.php" class="active">Permohonan Masuk</a></li>';
							} else {
								echo '<li><a href="app_wait.php">Permohonan Masuk</a></li>';
							}
							if ($pagedesc == "Approved") {
								echo '<li><a href="app.php" class="active">Diterima</a></li>';
							} else {
								echo '<li><a href="app.php">Diterima</a></li>';
							}
							if ($pagedesc == "Declined") {
								echo '<li><a href="app_decline.php" class="active">Ditolak</a></li>';
							} else {
								echo '<li><a href="app_decline.php">Ditolak</a></li>';
							}
							if ($pagedesc == "Pengajuan Selesai") {
								echo '<li><a href="app_all.php" class="active">Selesai</a></li>';
							} else {
								echo '<li><a href="app_all.php">Selesai</a></li>';
							}
							?>
                        </ul><!-- /.nav-second-level -->
                    </ul>
                </div>
            </div>
        </nav>