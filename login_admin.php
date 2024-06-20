<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location: /index.php");
}

$pagedesc = "Login";

require_once('function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= APP_TITLE ?> &mdash; <?php echo $pagedesc ?></title>

    <link href="/libs/images/Logo_BPN-KemenATR.png" rel="icon" type="images/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/offline-font.css" rel="stylesheet">
    <link href="/dist/css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="/libs/jquery/dist/jquery.min.js"></script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Lilita+One&display=swap');
    </style>
    <style>
    .judul {
        font-family: "Lilita One", sans-serif;
        font-size: 24px;
        font-weight: 400;
        font-style: normal;
        text-align: center;
        margin-top: 10px;
    }
    </style>
</head>

<body
    style="background-image: url('/libs/images/bg_login.png'); background-size:cover; background-position: center center;">

    <section id="main-wrapper" style="margin-top: 120px">
        <div class="container-fluid">

            <div class="row">

                <div id="page-wrapper" class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4"
                    style="background-color: #ffffff; border-radius: 3px; box-shadow: 0 1px 1px rgba(0,0,0,.05)">
                    <div class="row">
                        <div class="col-lg-12">
                            <br />
                            <center><img src="/libs/images/Logo_BPN-KemenATR.png" width="120" height="auto"></center>
                            <div class="judul">KANTOR PERTANAHAN KABUPATEN SRAGEN <p>"SECANTING"
                                <p>Sistem Elektronik Cek Tanah dan Plotting
                            </div>
                        </div>
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default" style="margin-bottom: 0;">
                                    <div class="panel-body" style="padding-bottom: 0;">
                                        <?php include("layout_alert.php"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <form action="/login_auth.php" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="Username" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3"></div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary btn-block"
                                                            name="login" value="Masuk">
                                                    </div>
                                                    <div class="form-group">
                                                        <a href="<?php echo baseurl(''); ?>"
                                                            class="btn btn-success btn-block">Kembali Ke Halaman
                                                            Utama</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3"></div>
                                            </div>
                                            <center>
                                                <p>&copy; <?= date('Y') ?> &mdash; ATR/BPN Kabupaten Sragen</p>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container -->
    </section>

    <!-- footer-bottom -->
    <div class="navbar navbar-inverse navbar-fixed-bottom footer-bottom">
        <div class="container text-center">
            <p class="text-center" style="color: #D1C4E9; margin: 0 0 5px; padding: 0"><small><?= APP_TITLE ?></small>
            </p>
        </div>
    </div><!-- /.footer-bottom -->

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>