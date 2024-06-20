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
    $no_ktp = $_POST["no_ktp"];
    $nama = $_POST["nama"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $umur = $_POST["umur"];
    $pekerjaan = $_POST["pekerjaan"];
    $id_notaris = $_POST["notaris"];
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
    $tanggal_pengajuan = $_POST["tanggal_pengajuan"]; // Ambil tanggal_pengajuan dari $_POST
    $status_pengajuan = "Awaiting";

    // Prepare statement
    $sql = "INSERT INTO pengajuan (no_ktp, nama, tanggal_lahir, umur, pekerjaan, id_notaris, id_desa, selaku, kecamatan, alamat_rumah, no_hp, lokasi_tanah, koordinat_x, koordinat_y, jenis_hak, no_hak, no_su, nib, luas, penggunaan, tanggal_pengajuan, status_pengajuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssssssssssssssssss", $no_ktp, $nama, $tanggal_lahir, $umur, $pekerjaan, $id_notaris, $id_desa, $selaku, $kecamatan, $alamat_rumah, $no_hp, $lokasi_tanah, $koordinat_x, $koordinat_y, $jenis_hak, $no_hak, $no_su, $nib, $luas, $penggunaan, $tanggal_pengajuan, $status_pengajuan);

    // Execute statement
    $stmt->execute();

    // Check for errors
    if ($stmt->errno) {
        // Handle error
        // Example: echo "Error: " . $stmt->error;
    } else {
        // Query executed successfully
        $sukses = 'sukses';
    }

    // Close statement
    $stmt->close();

    
    $no_ktpk = $_POST["no_ktpk"];
    $nama_kuasa = $_POST["nama_kuasa"];
    $ttl_kuasa = $_POST["ttl_kuasa"];
    $umur_kuasa = $_POST["umur_kuasa"];
    $pekerjaan_kuasa = $_POST["pekerjaan_kuasa"];
    $alamat_kuasa = $_POST["alamat_kuasa"];

    $sqll = "INSERT INTO data_kuasa (no_ktpk, nama_kuasa, ttl_kuasa, umur_kuasa, pekerjaan_kuasa, alamat_kuasa) VALUES ('$no_ktpk','$nama_kuasa','$ttl_kuasa', '$umur_kuasa', '$pekerjaan_kuasa', '$alamat_kuasa')";

    if ($conn->query($sqll) === TRUE) {
        $sukses = 'sukses';
    } else {
        // echo "<script>alert('Error inserting data into the database: " . $conn->error . "');</script>";
        $gagal[1] = 'gagal-database';
        array_push($gagalArr, $gagal[1]);
    }

    // Menutup koneksi
    $conn->close();
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

    <title>Buat Pengajuan Sertifikat Tanah</title>

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

    <!-- Alertify JS -->
    <script src="/libs/jquery/dist/alertify.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>

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
    #bottomLeftImage {
        position: fixed;
        bottom: 0;
        right: 20px;
        width: 200px;
        /* Sesuaikan lebar gambar */
        height: auto;
        /* Biarkan tinggi mengikuti perubahan lebar */
    }
    </style>

</head>


<body style="background-image: url('/libs/images/1.png'); background-size: cover; background-position: center center;">
    >
    <img id="bottomLeftImage" src="/libs/images/mbakmbakplotingyuk.png" alt="Mbak Plot">
    <form action="pengajuan_sertifikat" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="container">
            <div class="text-center">
                <img src="libs/images/Logo_BPN-KemenATR.png" width="64" height="auto" alt="BPN-KemenATR Logo">
                <h2>Buat Pengajuan Sertifikat Tanah</h2>
            </div>

            <?php if (isset($_POST) && !empty($gagal)) : ?>
            <div id="validationErrorAlert" class="alert alert-danger alert-dismissible" role="alert"
                style="margin-top : 20px; margin-bottom : 20px;">
                <a class="close" aria-label="close" id="validationErrorClose">&times;</a>

                <strong>Pengajuan Sertifikat gagal!</strong>
                </button>
            </div>
            <?php elseif (isset($_POST) && !empty($sukses)) : ?>
            <div id="validationErrorAlert" class="alert alert-success alert-dismissible" role="alert"
                style="margin-top : 20px; margin-bottom : 20px;">
                <a class="close" aria-label="close" id="validationErrorClose">&times;</a>
                <strong>Pengajuan Sertifikat berhasil.<br>Terima kasih.</strong>
            </div>
            <?php endif; ?>
            <?php
        // Memanggil file koneksi.php
        // include("dist/config/koneksi.php");
        ?>
            <h3>Data Diri</h3>
            <div class="form-group">
                <label for="notaris">Notaris/PPAT:</label>
                <select class="form-control" name="notaris" required>
                    <option value="" disabled selected>Pilih Notaris</option>
                    <?php
                    // Menyimpan hasil query ke dalam array
                    while ($row_notaris = $result_notaris->fetch_assoc()) {
                        echo "<option value='" . $row_notaris['id_notaris'] . "'>" . $row_notaris['nama_notaris'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="no_ktp">No KTP:</label>
                <input type="text" class="form-control" name="no_ktp" placeholder="Masukkan No KTP" autofocus required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Pemohon:</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" autofocus required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tempat, Tanggal Lahir:</label>
                <input type="text" class="form-control" name="tanggal_lahir"
                    placeholder="Contoh: Bondowoso, 31 Oktober 1999" autofocus required>
            </div>
            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="text" class="form-control" name="umur" placeholder="Masukkan Umur" autofocus required>
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan:</label>
                <input type="text" class="form-control" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="alamat_rumah">Alamat Rumah:</label>
                <input type="text" class="form-control" name="alamat_rumah" placeholder="Masukkan Alamat Rumah"
                    autofocus required>
            </div>
            <div class="form-group">
                <label for="no_hp">NO HP:</label>
                <input type="text" class="form-control" name="no_hp" placeholder="Masukkan NO HP" autofocus required>
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
            <h3>Data Kuasa</h3>
            <div class="form-group">
                <label for="no_ktpk">No KTP:</label>
                <input type="text" class="form-control" name="no_ktpk" placeholder="Masukkan No KTP" autofocus>
            </div>
            <div class="form-group">
                <label for="nama_kuasa">Nama:</label>
                <input type="text" class="form-control" name="nama_kuasa" placeholder="Masukkan Nama Kuasa" autofocus>
            </div>
            <div class="form-group">
                <label for="ttl_kuasa">Tempat, Tanggal Lahir:</label>
                <input type="text" class="form-control" name="ttl_kuasa"
                    placeholder="Contoh: Bondowoso, 31 Oktober 1999" autofocus>
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
                <input type="text" class="form-control" name="alamat_kuasa" placeholder="Masukkan Alamat Kuasa"
                    autofocus>
            </div>
        </div>
        <div class=" container">
            <h3>Data Tanah</h3>
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
                <label for="lokasi_tanah">Lokasi Tanah:</label>
                <input type="text" class="form-control" name="lokasi_tanah" placeholder="Masukkan Lokasi Tanah"
                    autofocus required>
            </div>
            <div class="form-group">
                <label for="koordinat_x">Koordinat X:</label>
                <input type="text" class="form-control" name="koordinat_x" placeholder="Masukkan Koordinat X" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="koordinat_y">Koordinat Y:</label>
                <input type="text" class="form-control" name="koordinat_y" placeholder="Masukkan Koordinat Y" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="jenis_hak">Jenis Hak:</label>
                <select class="form-control" name="jenis_hak" required>
                    <option value="" disabled selected>Pilih Opsi</option>
                    <option value="hak_milik">Hak Milik</option>
                    <option value="hak_guna_usaha">Hak Guna Usaha</option>
                    <option value="hak_guna_bangunan">Hak Guna Bangunan</option>
                    <option value="hak_pakai">Hak Pakai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hak">No HAK:</label>
                <input type="text" class="form-control" name="no_hak" placeholder="Masukkan No HAK" autofocus required>
            </div>
            <div class="form-group">
                <label for="no_su">No SU:</label>
                <input type="text" class="form-control" name="no_su" placeholder="Masukkan No SU" autofocus required>
            </div>
            <div class="form-group">
                <label for="nib">NIB:</label>
                <input type="text" class="form-control" name="nib" placeholder="Masukkan NIB" autofocus required>
            </div>
            <div class="form-group">
                <label for="luas">Luas Tanah(m2):</label>
                <input type="text" class="form-control" name="luas" placeholder="Masukkan Luas Tanah" autofocus
                    required>
            </div>
            <div class="form-group">
                <label for="penggunaan">Penggunaan:</label>
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
        $('#selaku').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption === 'kuasa') {
                $('#dataKuasaSection').show();
            } else {
                $('#dataKuasaSection').hide();
            }
        });
    });
    </script>

    <script>
    function validateAndSubmitForm(event) {
        // Sembunyikan alert kesalahan validasi jika sebelumnya ditampilkan
        document.getElementById('validationErrorAlert').style.display = 'none';
        // Mengubah warna tombol submit menjadi biru
        var submitButton = document.querySelector('form button[type="submit"]');
        submitButton.classList.remove('btn-success'); // Menghapus kelas btn-success
        submitButton.classList.add('btn-primary'); // Menambahkan kelas btn-primary
        return true;
    }

    // Hook ke acara onsubmit formulir untuk memanggil fungsi validasi
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

    <!-- Bootstrap Core JavaScript -->
    <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>