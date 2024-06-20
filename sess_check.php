<?php
// memulai session
session_set_cookie_params(3 * 60 * 60); // Timeout sesi 3 jam
session_start();

// membaca nilai variabel session 
$chk_sess = $_SESSION['admin'];

// memanggil file koneksi
include("dist/config/koneksi.php");
include("dist/config/library.php");

// mengambil data pengguna dari tabel pengguna
$sql_sess = "SELECT * FROM admin WHERE id_admin='" . $chk_sess . "'";
$ress_sess = mysqli_query($conn, $sql_sess);
$row_sess = mysqli_fetch_array($ress_sess);

// menyimpan id_pengguna yang sedang login
$sess_admid = $row_sess['id_admin'];
$sess_admuser = $row_sess['nama'];
$sess_admname = $row_sess['user'];

// mengarahkan ke halaman login.php apabila session belum terdaftar
if (!isset($chk_sess)) {
    header("location: /admin/login");
    exit();
}

// Memperbarui timestamp sesi pada setiap interaksi pengguna
$_SESSION['last_activity'] = time();

// Memeriksa timeout pada setiap halaman
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3 * 60 * 60)) {
    // Sesuaikan dengan timeout yang diinginkan
    session_unset();
    session_destroy();
    header("Location: /admin/login");
    exit();
}