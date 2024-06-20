<?php
include_once("function.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <title>404 - Halaman Tidak Ditemukan</title>

    <link href="/libs/images/icon-pemkab-kediri.png" rel="icon" type="images/x-icon">
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
        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: sans-serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {
            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
        }

        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .link_404:hover {
            text-decoration: none;
        }

        .contant_box_404 {
            margin-top: -50px;
        }
    </style>
</head>

<body>
    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">404</h1>
                        </div>
                        <div class="contant_box_404">
                            <h3 class="h2">
                                Maaf, Halaman Tidak Ditemukan
                            </h3>
                            <p> &copy; <?= date('Y') ?> &mdash; ATR/BPN Kabupaten Sragen</p>
                            <a href="<?php echo baseurl(''); ?>" class="link_404">Kembali Ke Halaman Utama</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>