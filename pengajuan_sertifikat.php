<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location: /index.php");
}

include_once("function.php");
require_once('dist/config/koneksi.php');

$sql_notaris = "SELECT id_notaris, nama_notaris FROM master_notaris";
$result_notaris = $conn->query($sql_notaris);
$sql_kecamatan = "SELECT DISTINCT kecamatan FROM master_desa"; // Mengambil daftar kecamatan yang unik dari tabel master_desa
$result_kecamatan = $conn->query($sql_kecamatan);

$kecamatanArray = []; // Array untuk menyimpan nama-nama kecamatan

// Memeriksa hasil query
if ($result_kecamatan->num_rows > 0) {
    // Menyimpan nama-nama kecamatan ke dalam array
    while ($row_kecamatan = $result_kecamatan->fetch_assoc()) {
        $kecamatanArray[] = $row_kecamatan['kecamatan'];
    }
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $gagalArr = [];
    $gagal = [];
    $sukses = '';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get other form data
    // Check if file upload is set and if there is no error
    if (
        isset($_FILES["scan"]) && $_FILES["scan"]["error"] === UPLOAD_ERR_OK &&
        isset($_FILES["ss_gmap"]) && $_FILES["ss_gmap"]["error"] === UPLOAD_ERR_OK
    ) {

        // Define maximum file size for each file (2 MB)
        $maxFileSize = 2 * 1024 * 1024; // 2 MB dalam bytes

        // Check file size for scan
        if ($_FILES["scan"]["size"] > $maxFileSize) {
            // Handle file size error for scan
            $gagal[0] = 'gagal-file-size-scan';
            array_push($gagalArr, $gagal[0]);
        } else {
            // File upload handling for scan
            $targetDirScan = "scan/";
            $scanFileName = basename($_FILES["scan"]["name"]);
            // Mengganti spasi dengan garis bawah
            $scanFileName = str_replace(' ', '-', $scanFileName);
            $targetFileScan = $targetDirScan . $scanFileName;
            
            if (move_uploaded_file($_FILES["scan"]["tmp_name"], $targetFileScan)) {
                // File berhasil diunggah untuk pemindaian
                $scan = $scanFileName;
            } else {
                // Mengatasi kesalahan unggah untuk pemindaian
                $gagal[1] = 'gagal-upload-scan';
                array_push($gagalArr, $gagal[1]);
            }

        }

        // Check file size for ss_gmap
        if ($_FILES["ss_gmap"]["size"] > $maxFileSize) {
            // Handle file size error for ss_gmap
            $gagal[2] = 'gagal-file-size-ss_gmap';
            array_push($gagalArr, $gagal[2]);
        } else {
            // File upload handling for ss_gmap
            $targetDirGmap = "ss_gmap/";
            $gmapFileName = basename($_FILES["ss_gmap"]["name"]);
            $gmapFileName = str_replace(' ', '-', $gmapFileName);
            $targetFileGmap = $targetDirGmap . $gmapFileName;

            if (move_uploaded_file($_FILES["ss_gmap"]["tmp_name"], $targetFileGmap)) {
                // File uploaded successfully for ss_gmap
                $ss_gmap = $gmapFileName;
            } else {
                // Handle upload error for ss_gmap
                $gagal[3] = 'gagal-upload-ss_gmap';
                array_push($gagalArr, $gagal[3]);
            }
        }
    }

    $no_ktp = $_POST["no_ktp"];
    $nama = $_POST["nama"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $umur = $_POST["umur"];
    $pekerjaan = $_POST["pekerjaan"];
    $email = $_POST["email"];
    $nama_notaris = $_POST["nama_notaris"];
    $id_desa = $_POST["desa"];
    $selaku = $_POST["selaku"];
    $kecamatan = $_POST["kecamatan"];
    $alamat_rumah = $_POST["alamat_rumah"];
    $no_hp = $_POST["no_hp"];
    $lokasi_tanah = $_POST["lokasi_tanah"];
    $koordinat_x = $_POST["koordinat_x"];
    $koordinat_y = $_POST["koordinat_y"];
    $jenis_hak = $_POST["jenis_hak"];
    $no_hak = $_POST["no_hak"];
    $no_su = $_POST["no_su"];
    $nib = $_POST["nib"];
    $luas = $_POST["luas"];
    $penggunaan = $_POST["penggunaan"];
    $tanggal_pengajuan = $_POST["tanggal_pengajuan"]; 
    $status_pengajuan = "Awaiting";

    
    $no_ktpk = $_POST["no_ktpk"];
    $nama_kuasa = $_POST["nama_kuasa"];
    $ttl_kuasa = $_POST["ttl_kuasa"];
    $umur_kuasa = $_POST["umur_kuasa"];
    $pekerjaan_kuasa = $_POST["pekerjaan_kuasa"];
    $alamat_kuasa = $_POST["alamat_kuasa"];

    $sqll = "INSERT INTO data_kuasa (no_ktpk, nama_kuasa, ttl_kuasa, umur_kuasa, pekerjaan_kuasa, alamat_kuasa) VALUES ('$no_ktpk','$nama_kuasa','$ttl_kuasa', '$umur_kuasa', '$pekerjaan_kuasa', '$alamat_kuasa')";

    if ($conn->query($sqll) === TRUE) {
        $id_kuasa = $conn->insert_id;
        $sukses = 'sukses';
    } else {
        $gagal[1] = 'gagal-database';
        array_push($gagalArr, $gagal[1]);
    }
    $sql = "INSERT INTO pengajuan (id_kuasa, nama, no_ktp, tanggal_lahir, umur, pekerjaan, email, nama_notaris, id_desa, selaku, kecamatan, alamat_rumah, no_hp, lokasi_tanah, ss_gmap, koordinat_x, koordinat_y, scan, jenis_hak, no_hak, no_su, nib, luas, penggunaan, tanggal_pengajuan, status_pengajuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("isssssssssssssssssssssssss", $id_kuasa, $nama, $no_ktp, $tanggal_lahir, $umur, $pekerjaan, $email, $nama_notaris, $id_desa, $selaku, $kecamatan, $alamat_rumah, $no_hp, $lokasi_tanah, $targetFileGmap, $koordinat_x, $koordinat_y, $targetFileScan, $jenis_hak, $no_hak, $no_su, $nib, $luas, $penggunaan, $tanggal_pengajuan, $status_pengajuan);
    $stmt->execute();

    // Check for errors
    if ($stmt->errno) {
    } else {
        $sukses = 'sukses';
    }

    $stmt->close();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= APP_TITLE ?></title>

    <link href="/libs/images/Logo_BPN-KemenATR.png" rel="icon" type="images/x-icon">


    <!-- Bootstrap Core CSS -->
    <link href="/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/libs/bootstrap/dist/css/bootstrap-alert.min.css" rel="stylesheet">
    <link href="/libs/bootstrap/dist/css/alertify.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/offline-font.css" rel="stylesheet">
    <link href="/dist/css/sertif.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="/libs/jquery/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Alertify JS -->
    <script src="/libs/jquery/dist/alertify.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    <!-- Your Other Scripts -->
    <script>
    $(document).ready(function() {
        // Inisialisasi datepicker pada input dengan nama "tanggal_acara"
        $('input[name="tanggal_acara"]').datepicker({
            format: 'dd MM yyyy',
            autoclose: true,
            todayHighlight: true,
            endDate: new Date() // Menetapkan tanggal maksimum sebagai tanggal sekarang
        });
    });
    </script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Lilita+One&display=swap');
    </style>
    <style>
    #bottomLeftImage {
        position: fixed;
        bottom: 0;
        right: 20px;
        width: 200px;
        height: auto;
    }

    #topRightImage {
        position: fixed;
        top: 0px;
        left: 8%;
        width: 200px;
        height: auto;
    }


    .judul {
        font-family: "Lilita One", sans-serif;
        font-size: 24px;
        font-weight: 400;
        font-style: normal;
        margin-top: 10px;

    }

    h3 {
        font-weight: bold;
    }
    </style>
    <script>
    function GetDetail(notarisId) {
        if (!notarisId) {
            document.getElementById("nama").value = "";
            document.getElementById("no_ktp").value = "";
            document.getElementById("tanggal_lahir").value = "";
            document.getElementById("umur").value = "";
            document.getElementById("pekerjaan").value = "";
            document.getElementById("alamat_rumah").value = "";
            document.getElementById("no_hp").value = "";
            document.getElementById("email").value = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myObj = JSON.parse(this.responseText);
                    document.getElementById("nama").value = myObj.nama_notaris;
                    document.getElementById("no_ktp").value = myObj.nik_notaris;
                    document.getElementById("tanggal_lahir").value = myObj.ttl_notaris;
                    document.getElementById("umur").value = myObj.umur;
                    document.getElementById("pekerjaan").value = myObj.pekerjaan_notaris;
                    document.getElementById("alamat_rumah").value = myObj.alamat_notaris;
                    document.getElementById("no_hp").value = myObj.hp_notaris;
                    document.getElementById("email").value = myObj.email_notaris;
                }
            };
            xmlhttp.open("GET", "get_notaris_data.php?id_notaris=" + notarisId, true);
            xmlhttp.send();
        }
    }
    </script>

</head>


<body
    style="background-image: url('/libs/images/ddd.png'); background-size: cover; background-position: center center;">
    >
    <img id="bottomLeftImage" src="/libs/images/mbakmbakplotingyuk.png" alt="Mbak Plot">
    <form action="pengajuan_sertifikat" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="container" style="opacity : 0.95;">
            <div class="text-center">
                <img src="libs/images/Logo_BPN-KemenATR.png" width="128" height="auto" alt="BPN-KemenATR Logo">
                <div class="judul">KANTOR PERTANAHAN KABUPATEN SRAGEN <p>"SECANTING"
                    <p>Sistem Elektronik Cek Tanah dan Plotting
                </div>
            </div>

            <?php if (isset($_POST) && !empty($gagal)) : ?>
            <div id="validationErrorAlert" class="alert alert-danger alert-dismissible" role="alert"
                style="margin-top : 20px; margin-bottom : 20px;">
                <a class="close" aria-label="close" id="validationErrorClose">&times;</a>

                <strong>Pengajuan Plot gagal!</strong>
                <?php
                    if (in_array("gagal-upload-scan", $gagalArr)) {
                        echo "<br>Kesalahan upload file scan pada server";
                    }
                    if (in_array("gagal-file-size-scan", $gagalArr)) {
                        echo "<br>Ukuran File Scan Melebihi 2 MB";
                    }
                    if (in_array("gagal-upload-ss_gmap", $gagalArr)) {
                        echo "<br>Kesalahan upload Screenshot Google Map pada server";
                    }
                    if (in_array("gagal-file-size-ss_gmap", $gagalArr)) {
                        echo "<br>Ukuran File Screenshot Google Map Melebihi 2 MB";
                    }
                    if (in_array("gagal-database", $gagalArr)) {
                        echo "<br>Kesalahan pada database";
                    }
                    ?>
                </button>
            </div>
            <?php elseif (isset($_POST) && !empty($sukses)) : ?>
            <div id="validationErrorAlert" class="alert alert-success alert-dismissible" role="alert"
                style="margin-top : 20px; margin-bottom : 20px;">
                <a class="close" aria-label="close" id="validationErrorClose">&times;</a>
                <strong>Pengajuan Sertifikat berhasil.<br>Terima kasih.</strong>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <h3 for="jenis">Jenis Permohonan:</h3>
                <select class="form-control" name="jenis" id="jenis" required>
                    <option value="" disabled selected>Pilih Opsi</option>
                    <option value="perseorangan">Perseorangan</option>
                    <option value="ppat">Melalui Notaris/PPAT </option>
                </select>
            </div>
            <h3>Saya Yang Mengajukan Permohonan</h3>
            <div class="form-group" id="pilihan" style="display: none;">
                <label for="nama_notaris">Notaris/PPAT:</label>
                <select class="form-control js-example-basic-single" style="width: 100%;" name="nama_notaris" required
                    onchange="GetDetail(this.value)">
                    <option value="" disabled selected>Pilih Notaris</option>
                    <?php
                    // Menyimpan hasil query ke dalam array
                    while ($row_notaris = $result_notaris->fetch_assoc()) {
                        echo "<option value='" . $row_notaris['nama_notaris'] . "'>" . $row_notaris['nama_notaris'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama :</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="no_ktp">No KTP:</label>
                <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan No KTP"
                    autofocus required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tempat, Tanggal Lahir:</label>
                <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                    placeholder="Contoh: Sragen, 1 januari 2000" autofocus required>
            </div>
            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="text" class="form-control" name="umur" id="umur" placeholder="Masukkan Umur" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan:</label>
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"
                    placeholder="Masukkan Pekerjaan Anda" autofocus required>
            </div>
            <div class="form-group">
                <label for="alamat_rumah">Alamat:</label>
                <input type="text" class="form-control" name="alamat_rumah" id="alamat_rumah"
                    placeholder="Masukkan Alamat" autofocus required>
            </div>
            <div class="form-group">
                <label for="no_hp">NO HP:</label>
                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukkan NO HP" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" autofocus
                    required>
            </div>

            <div class="form-group">
                <label for="selaku">Bertindak Selaku:</label>
                <select class="form-control" name="selaku" id="selaku" required>
                    <option value="" disabled selected>Pilih Opsi</option>
                    <option value="diri_sendiri">Diri Sendiri</option>
                    <option value="kuasa">Kuasa</option>
                </select>
            </div>
        </div>

        <div class="container" id="dataKuasaSection" style="display: none;">
            <h3>Identitas Pemberi Kuasa</h3>
            <div class="form-group">
                <label for="nama_kuasa">Nama:</label>
                <input type="text" class="form-control" name="nama_kuasa" placeholder="Masukkan Nama Kuasa" autofocus>
            </div>
            <div class="form-group">
                <label for="no_ktpk">No KTP:</label>
                <input type="text" class="form-control" name="no_ktpk" placeholder="Masukkan No KTP" autofocus>
            </div>
            <div class="form-group">
                <label for="ttl_kuasa">Tempat, Tanggal Lahir:</label>
                <input type="text" class="form-control" name="ttl_kuasa" placeholder="Contoh: Sragen, 1 Januari 2000"
                    autofocus>
            </div>
            <div class="form-group">
                <label for="umur_kuasa">Umur:</label>
                <input type="text" class="form-control" name="umur_kuasa" placeholder="Masukkan Umur Kuasa" autofocus>
            </div>
            <div class="form-group">
                <label for="pekerjaan_kuasa">Pekerjaan:</label>
                <input type="text" class="form-control" name="pekerjaan_kuasa" placeholder="Masukkan Pekerjaan Kuasa"
                    autofocus>
            </div>
            <div class="form-group">
                <label for="alamat_kuasa">Alamat:</label>
                <input type="text" class="form-control" name="alamat_kuasa" placeholder="Masukkan Alamat Pemberi Kuasa"
                    autofocus>
            </div>
        </div>
        <div class=" container">
            <h3>Identifikasi Bidang Tanah Dimohon Cek Plot</h3>
            <div class="form-group">
                <label for="kecamatan">Kecamatan:</label>
                <select class="form-control" name="kecamatan" required id="camat">
                    <option value="">Pilih Kecamatan</option>
                    <?php
                    // Menampilkan pilihan kecamatan
                    foreach ($kecamatanArray as $kecamatan) {
                        echo "<option value='" . $kecamatan . "'>" . $kecamatan . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_acara"></label>
                <input type="hidden" name="tanggal_pengajuan" value="<?php echo date('Y-m-d H:i:s'); ?>">
            </div>

            <div class="form-group">
                <label for="desa">Desa/Kelurahan : </label>
                <select class="form-control" name="desa" required id="desa" required>
                    <option value="" disabled selected>Pilih desa</option>
                </select>
            </div>

            <div class="form-group">
                <label for="lokasi_tanah">Lokasi Bidang Tanah:</label>
                <input type="text" class="form-control" name="lokasi_tanah" placeholder="Jl. Veteran No.10" autofocus
                    required>
            </div>
            <div id="map" style="height: 400px; width: 100%; margin-bottom: 20px;"></div>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

            <div class="form-group">
                <label for="ss_gmap">Screenshot Google Maps Lokasi Bidang Tanah</label>
                <label for="scan">Ukuran File Maks: 2MB</label>
                <a href="/libs/images/contoh_ss.png" target="_blank">Contoh Gambar</a>

                <input type="file" class="form-control" name="ss_gmap" accept=".jpg, .jpeg, .png" required>
            </div>
            <div class="form-group">
                <label for="koordinat_x">Koordinat X:</label>
                <input type="text" class="form-control" name="koordinat_x" id="koordinat_x"
                    placeholder="Masukkan Koordinat X" autofocus required>
            </div>
            <div class="form-group">
                <label for="koordinat_y">Koordinat Y:</label>
                <input type="text" class="form-control" name="koordinat_y" id="koordinat_y"
                    placeholder="Masukkan Koordinat Y" autofocus required>
            </div>
            <div class="form-group">
                <label for="scan">Scan Sertipikat Hak Atas Tanah</label>
                <label for="scan">Ukuran File Maks: 2MB</label>
                <input type="file" class="form-control" name="scan" accept=".pdf" required>
            </div>
            <div class="form-group">
                <label for="jenis_hak">Jenis Hak Atas Tanah:</label>
                <select class="form-control" name="jenis_hak" required>
                    <option value="" disabled selected>Pilih Opsi</option>
                    <option value="hak_milik">Hak Milik</option>
                    <option value="hak_guna_usaha">Hak Guna Usaha</option>
                    <option value="hak_guna_bangunan">Hak Guna Bangunan</option>
                    <option value="hak_pakai">Hak Pakai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hak">No Hak Atas Tanah:</label>
                <input type="text" class="form-control" name="no_hak" placeholder="Masukkan No Hak Atas Tanah" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="no_su">No Surat Ukur:</label>
                <input type="text" class="form-control" name="no_su" placeholder="Masukkan No Surat Ukur" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="nib">Nomor Identifikasi Bidang (NIB):</label>
                <input type="text" class="form-control" name="nib"
                    placeholder="Masukkan Nomor Identifikasi Bidang (NIB)" autofocus required>
            </div>
            <div class="form-group">
                <label for="luas">Luas Tanah (m2):</label>
                <input type="text" class="form-control" name="luas" placeholder="Masukkan Luas Tanah" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="penggunaan">Penggunaan Tanah:</label>
                <input type="text" class="form-control" name="penggunaan" placeholder="Masukkan Penggunaan" autofocus
                    required>
            </div>
            <div class="form-group">
                <center><button type="submit" class="btn btn-primary">Kirim Pengajuan</button></center>
            </div>
        </div>
    </form>
    <div class="navbar-inverse navbar-fixed-bottom">
        <p class="text-center" style="color: #D1C4E9; margin: 0 0 5px; padding: 0">
            <small><?= APP_TITLE ?><br>&copy;
                <?= date('Y') ?> &mdash; ATR/BPN Kabupaten Sragen
        </p>
    </div><!-- /.footer-bottom -->

    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Pilih Notaris",
            allowClear: true
        });
    });
    $(document).ready(function() {
        $('#selaku').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption === 'kuasa') {
                $('#dataKuasaSection').show();
            } else {
                $('input[name="no_ktpk"]').val("");
                $('input[name="nama_kuasa"]').val("");
                $('input[name="ttl_kuasa"]').val("");
                $('input[name="umur_kuasa"]').val("");
                $('input[name="pekerjaan_kuasa"]').val("");
                $('input[name="alamat_kuasa"]').val("");
                $('#dataKuasaSection').hide();
            }
        });
    });
    $(document).ready(function() {
        $('#jenis').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption === 'ppat') {
                $('#pilihan').show();
            } else {
                $('#pilihan').hide();
            }
        });
    });
    </script>
    <script>
    $(document).on('click', '.close', function() {
        $(this).closest('.alert').hide();
    });
    </script>
    <script>
    // Initialize the map, centered at a default location with zoom level 19
    var map = L.map('map').setView([-7.429530, 111.023945], 19);

    // Add tile layer to the map
    L.tileLayer('https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=rM8OT2Aczjvpe4obFdF7', {
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
    }).addTo(map);

    // Function to set map view to user's current location
    function setMapToCurrentLocation(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        map.setView([lat, lon], 19);

        // Optionally, you can add a marker at the user's location
        L.marker([lat, lon]).addTo(map)
            .bindPopup("Lokasi Anda Disini!")
            .openPopup();
    }

    // Function to handle error in getting location
    function handleLocationError(error) {
        console.log("Error getting location: " + error.message);
    }

    // Request user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(setMapToCurrentLocation, handleLocationError);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }

    // Add popup functionality on map click
    var popup = L.popup();

    function onMapClick(e) {
        var latlng = e.latlng;
        popup
            .setLatLng(latlng)
            .setContent("<b>Lokasi Tanah Disini</b>")
            .openOn(map);

        // Set the input fields to the clicked coordinates
        document.getElementById('koordinat_x').value = latlng.lat.toFixed(6);
        document.getElementById('koordinat_y').value = latlng.lng.toFixed(6);
    }
    map.on('click', onMapClick);
    </script>
    <script>
    function validateEmail() {
        var emailInput = document.getElementById('emailInput');
        var emailError = document.getElementById('emailError');
        // Regular expression untuk memeriksa format email
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        // Memeriksa apakah nilai email sesuai dengan pola
        if (!emailPattern.test(emailInput.value)) {
            // Menampilkan pesan kesalahan jika tidak sesuai
            emailError.innerHTML = 'Email tidak valid. Masukkan email dengan format yang benar.';
            return false;
        } else {
            // Menghapus pesan kesalahan jika email valid
            emailError.innerHTML = '';
            return true;
        }
    }

    function validateAndSubmitForm(event) {
        // Validasi email
        if (!validateEmail()) {
            // Menampilkan alert kesalahan validasi
            document.getElementById('validationErrorAlert').style.display = 'block';
            event.preventDefault(); // Mencegah formulir dikirim jika validasi gagal
            return false;
        }
        document.getElementById('validationErrorAlert').style.display = 'none';
        return true;
        // Mengubah warna tombol submit menjadi biru
        var submitButton = document.querySelector('form button[type="submit"]');

    }
    document.querySelector('form').addEventListener('submit', validateAndSubmitForm);
    </script>
    <script>
    $(document).ready(function() {
        // Menangani perubahan pada opsi kecamatan
        $('#camat').change(function() {
            var kecamatanId = $(this).val();
            var url = "<?= baseUrl('ajax.php') ?>";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    kecamatan: kecamatanId
                },
                success: function(response) {
                    $('#desa').html(
                        response
                    ); // Mengisi opsi desa dengan respons dari permintaan AJAX
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data desa.');
                }
            });
        });
    });
    </script>
    <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
    </script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>